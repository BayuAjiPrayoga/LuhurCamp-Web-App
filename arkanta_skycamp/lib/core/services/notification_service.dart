import 'dart:io';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:go_router/go_router.dart';
import '../network/api_client.dart';
import '../router/app_router.dart';

/// Background message handler - must be top-level function
@pragma('vm:entry-point')
Future<void> firebaseMessagingBackgroundHandler(RemoteMessage message) async {
  if (kDebugMode) {
    debugPrint('Handling background message: ${message.messageId}');
  }
}

class NotificationService {
  static final NotificationService _instance = NotificationService._internal();
  factory NotificationService() => _instance;
  NotificationService._internal();

  final FirebaseMessaging _messaging = FirebaseMessaging.instance;
  final FlutterLocalNotificationsPlugin _localNotifications =
      FlutterLocalNotificationsPlugin();

  String? _fcmToken;
  String? get fcmToken => _fcmToken;

  /// Initialize notification service
  Future<void> initialize() async {
    // Request permission
    await _requestPermission();

    // Initialize local notifications for foreground
    await _initializeLocalNotifications();

    // Get FCM token
    await _getFCMToken();

    // Auto-sync FCM token to backend if user is logged in
    await sendTokenToBackend(_fcmToken);

    // Listen for token refresh
    _messaging.onTokenRefresh.listen((token) async {
      _fcmToken = token;
      if (kDebugMode) debugPrint('FCM Token refreshed: $token');
      await sendTokenToBackend(token);
    });

    // Handle foreground messages
    FirebaseMessaging.onMessage.listen(_handleForegroundMessage);

    // Handle notification tap when app is in background
    FirebaseMessaging.onMessageOpenedApp.listen(_handleNotificationTap);

    // Check if app was opened from a notification
    final initialMessage = await _messaging.getInitialMessage();
    if (initialMessage != null) {
      _handleNotificationTap(initialMessage);
    }
  }

  /// Request notification permission
  Future<void> _requestPermission() async {
    final settings = await _messaging.requestPermission(
      alert: true,
      badge: true,
      sound: true,
      provisional: false,
    );

    if (kDebugMode) {
      debugPrint('Notification permission: ${settings.authorizationStatus}');
    }
  }

  /// Initialize local notifications for foreground display
  Future<void> _initializeLocalNotifications() async {
    const androidSettings = AndroidInitializationSettings(
      '@mipmap/ic_launcher',
    );
    const iosSettings = DarwinInitializationSettings(
      requestAlertPermission: true,
      requestBadgePermission: true,
      requestSoundPermission: true,
    );

    const initSettings = InitializationSettings(
      android: androidSettings,
      iOS: iosSettings,
    );

    await _localNotifications.initialize(
      initSettings,
      onDidReceiveNotificationResponse: (response) {
        if (kDebugMode) {
          debugPrint('Local notification tapped: ${response.payload}');
        }
        // Handle notification tap - navigate to specific screen
      },
    );

    // Create notification channel for Android
    if (Platform.isAndroid) {
      const channel = AndroidNotificationChannel(
        'luhurcamp_channel',
        'LuhurCamp Notifications',
        description: 'Notifikasi booking dan informasi LuhurCamp',
        importance: Importance.high,
      );

      await _localNotifications
          .resolvePlatformSpecificImplementation<
            AndroidFlutterLocalNotificationsPlugin
          >()
          ?.createNotificationChannel(channel);
    }
  }

  /// Get FCM token
  Future<String?> _getFCMToken() async {
    try {
      _fcmToken = await _messaging.getToken();
      if (kDebugMode) debugPrint('FCM Token: $_fcmToken');
      return _fcmToken;
    } catch (e) {
      if (kDebugMode) debugPrint('Error getting FCM token: $e');
      return null;
    }
  }

  /// Handle foreground message - show local notification
  void _handleForegroundMessage(RemoteMessage message) {
    if (kDebugMode) {
      debugPrint('Foreground message received: ${message.notification?.title}');
    }

    final notification = message.notification;
    if (notification != null) {
      _showLocalNotification(
        title: notification.title ?? 'LuhurCamp',
        body: notification.body ?? '',
        payload: message.data.toString(),
      );
    }
  }

  /// Handle notification tap
  void _handleNotificationTap(RemoteMessage message) {
    if (kDebugMode) {
      debugPrint('Notification tapped: ${message.data}');
    }

    // Navigate based on notification data
    final data = message.data;
    if (data.containsKey('booking_id')) {
      final bookingId = int.tryParse(data['booking_id'].toString());
      if (bookingId != null) {
        // Navigate to booking detail using global navigator key
        rootNavigatorKey.currentContext?.go('/booking/$bookingId');
      }
    } else if (data.containsKey('type') && data['type'] == 'announcement') {
      // Navigate to announcements
      rootNavigatorKey.currentContext?.go('/announcements');
    }
  }

  /// Show local notification
  Future<void> _showLocalNotification({
    required String title,
    required String body,
    String? payload,
  }) async {
    const androidDetails = AndroidNotificationDetails(
      'luhurcamp_channel',
      'LuhurCamp Notifications',
      channelDescription: 'Notifikasi booking dan informasi LuhurCamp',
      importance: Importance.high,
      priority: Priority.high,
      icon: '@mipmap/ic_launcher',
    );

    const iosDetails = DarwinNotificationDetails(
      presentAlert: true,
      presentBadge: true,
      presentSound: true,
    );

    const details = NotificationDetails(
      android: androidDetails,
      iOS: iosDetails,
    );

    await _localNotifications.show(
      DateTime.now().millisecondsSinceEpoch ~/ 1000,
      title,
      body,
      details,
      payload: payload,
    );
  }

  /// Subscribe to topic (e.g., 'announcements')
  Future<void> subscribeToTopic(String topic) async {
    await _messaging.subscribeToTopic(topic);
    if (kDebugMode) debugPrint('Subscribed to topic: $topic');
  }

  /// Unsubscribe from topic
  Future<void> unsubscribeFromTopic(String topic) async {
    await _messaging.unsubscribeFromTopic(topic);
    if (kDebugMode) debugPrint('Unsubscribed from topic: $topic');
  }

  /// Send FCM token to backend for push notification targeting
  Future<bool> sendTokenToBackend(String? token) async {
    if (token == null || token.isEmpty) {
      if (kDebugMode) debugPrint('FCM: No token to send to backend');
      return false;
    }

    try {
      // Only send if user is logged in (has auth token)
      final hasToken = await apiClient.hasToken();
      if (!hasToken) {
        if (kDebugMode) {
          debugPrint('FCM: User not logged in, skipping token sync');
        }
        return false;
      }

      await apiClient.put('/user/fcm-token', data: {'fcm_token': token});
      if (kDebugMode) debugPrint('FCM: Token sent to backend successfully');
      return true;
    } catch (e) {
      if (kDebugMode) debugPrint('FCM: Error sending token to backend: $e');
      return false;
    }
  }

  /// Remove FCM token from backend (on logout)
  Future<void> removeTokenFromBackend() async {
    try {
      await apiClient.delete('/user/fcm-token');
      if (kDebugMode) debugPrint('FCM: Token removed from backend');
    } catch (e) {
      if (kDebugMode) debugPrint('FCM: Error removing token: $e');
    }
  }

  /// Get current FCM token and optionally sync to backend
  Future<String?> getTokenAndSync() async {
    _fcmToken = await _messaging.getToken();
    if (_fcmToken != null) {
      await sendTokenToBackend(_fcmToken);
    }
    return _fcmToken;
  }
}

// Singleton instance
final notificationService = NotificationService();
