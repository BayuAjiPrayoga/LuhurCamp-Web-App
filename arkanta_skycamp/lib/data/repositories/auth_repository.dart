import 'package:dio/dio.dart';
import 'package:flutter/foundation.dart';
import '../../core/network/api_client.dart';
import 'package:firebase_auth/firebase_auth.dart'
    hide User; // Avoid conflict with user_model
import 'package:google_sign_in/google_sign_in.dart';
import '../../core/config/api_config.dart';
import '../models/user_model.dart';

// Debug logger - only prints in debug mode
void _log(String message) {
  if (kDebugMode) {
    debugPrint(message);
  }
}

class AuthRepository {
  final ApiClient _apiClient = apiClient;

  Future<AuthResult> login(String email, String password) async {
    try {
      final response = await _apiClient.post(
        ApiConfig.login,
        data: {'email': email, 'password': password},
      );

      if (response.statusCode == 200) {
        final responseData =
            response.data['data']; // Access nested 'data' object
        final token = responseData['token'];
        final user = User.fromJson(responseData['user']);

        await _apiClient.saveToken(token);

        return AuthResult.success(user: user, token: token);
      }

      return AuthResult.error(message: 'Login failed');
    } on DioException catch (e) {
      return AuthResult.error(
        message: e.response?.data['message'] ?? 'Network error',
      );
    } catch (e) {
      return AuthResult.error(message: e.toString());
    }
  }

  Future<AuthResult> register({
    required String name,
    required String email,
    required String password,
    required String passwordConfirmation,
    String? phone,
  }) async {
    try {
      final response = await _apiClient.post(
        ApiConfig.register,
        data: {
          'name': name,
          'email': email,
          'password': password,
          'password_confirmation': passwordConfirmation,
          'phone': phone,
        },
      );

      if (response.statusCode == 200 || response.statusCode == 201) {
        final responseData =
            response.data['data']; // Access nested 'data' object
        final token = responseData['token'];
        final user = User.fromJson(responseData['user']);

        await _apiClient.saveToken(token);

        return AuthResult.success(user: user, token: token);
      }

      return AuthResult.error(message: 'Registration failed');
    } on DioException catch (e) {
      final errors = e.response?.data['errors'];
      String message = 'Registration failed';

      if (errors != null && errors is Map) {
        final firstError = errors.values.first;
        if (firstError is List && firstError.isNotEmpty) {
          message = firstError.first.toString();
        }
      } else if (e.response?.data['message'] != null) {
        message = e.response!.data['message'];
      } else if (e.type == DioExceptionType.connectionTimeout ||
          e.type == DioExceptionType.receiveTimeout) {
        message = 'Koneksi timeout. Periksa koneksi internet Anda.';
      } else if (e.type == DioExceptionType.connectionError) {
        message =
            'Tidak dapat terhubung ke server. Pastikan server berjalan di http://192.168.1.117:8000';
      }

      return AuthResult.error(message: message);
    } catch (e) {
      return AuthResult.error(message: e.toString());
    }
  }

  Future<User?> getUser() async {
    try {
      final response = await _apiClient.get(ApiConfig.user);
      if (response.statusCode == 200) {
        return User.fromJson(response.data);
      }
      return null;
    } catch (e) {
      return null;
    }
  }

  Future<void> logout() async {
    try {
      await _apiClient.post(ApiConfig.logout);
    } finally {
      await _apiClient.clearToken();
    }
  }

  Future<bool> isLoggedIn() async {
    return await _apiClient.hasToken();
  }

  Future<UpdateProfileResult> updateProfile({
    required String name,
    String? phone,
  }) async {
    try {
      final response = await _apiClient.put(
        ApiConfig.updateProfile,
        data: {'name': name, if (phone != null) 'phone': phone},
      );

      if (response.statusCode == 200) {
        final userData = response.data['data'] ?? response.data;
        final user = User.fromJson(userData);
        return UpdateProfileResult.success(user: user);
      }

      return UpdateProfileResult.error(message: 'Update failed');
    } on DioException catch (e) {
      return UpdateProfileResult.error(
        message: e.response?.data['message'] ?? 'Network error',
      );
    } catch (e) {
      return UpdateProfileResult.error(message: e.toString());
    }
  }

  Future<AuthResult> updateAvatar(String imagePath) async {
    try {
      final formData = FormData.fromMap({
        'avatar': await MultipartFile.fromFile(imagePath),
      });

      final response = await _apiClient.postFormData(
        '${ApiConfig.baseUrl}/user/avatar',
        formData,
      );

      if (response.statusCode == 200) {
        final userData = response.data['data'] ?? response.data;
        final user = User.fromJson(userData);
        return AuthResult.success(
          user: user,
          token: '',
        ); // Token not needed here
      }

      return AuthResult.error(message: 'Update avatar failed');
    } on DioException catch (e) {
      return AuthResult.error(
        message: e.response?.data['message'] ?? 'Network error',
      );
    } catch (e) {
      return AuthResult.error(message: e.toString());
    }
  }

  Future<AuthResult> changePassword({
    required String currentPassword,
    required String newPassword,
    required String confirmPassword,
  }) async {
    try {
      final response = await _apiClient.post(
        '${ApiConfig.baseUrl}/user/change-password',
        data: {
          'current_password': currentPassword,
          'password': newPassword,
          'password_confirmation': confirmPassword,
        },
      );

      if (response.statusCode == 200) {
        return AuthResult.success(user: User.empty(), token: ''); // Dummy user
      }

      return AuthResult.error(message: 'Change password failed');
    } on DioException catch (e) {
      return AuthResult.error(
        message: e.response?.data['message'] ?? 'Network error',
      );
    } catch (e) {
      return AuthResult.error(message: e.toString());
    }
  }

  Future<AuthResult> loginWithGoogle() async {
    try {
      _log('=== GOOGLE SIGN IN STARTED ===');

      // 1. Trigger Google Sign-In
      // serverClientId adalah Web Client ID dari Firebase Console (OAuth 2.0 Client IDs)
      // WAJIB untuk mendapatkan idToken dari Google Sign-In
      final googleSignIn = GoogleSignIn(
        scopes: ['email', 'profile'],
        serverClientId:
            '120652636812-l2gqg4oh47uhc2n6adbfgk5nv4ojjkig.apps.googleusercontent.com',
      );

      // Sign out terlebih dahulu untuk memastikan fresh sign-in
      try {
        await googleSignIn.disconnect();
      } catch (e) {
        // Ignore if already disconnected
      }

      GoogleSignInAccount? googleUser;
      try {
        _log('[1] CALLING signIn()...');
        googleUser = await googleSignIn.signIn();
        _log('[1] signIn() COMPLETED');
      } catch (signInError) {
        _log('[1] SIGN IN ERROR: $signInError');
        return AuthResult.error(message: 'Google Sign-In Error: $signInError');
      }

      if (googleUser == null) {
        _log('[1] GOOGLE USER NULL - User cancelled');
        return AuthResult.error(message: 'Login Google dibatalkan');
      }
      _log('[1] GOOGLE USER OBTAINED: ${googleUser.email}');

      // 2. Obtain OAuth Details
      _log('[2] Getting authentication...');
      final GoogleSignInAuthentication googleAuth =
          await googleUser.authentication;
      _log('[2] GOOGLE AUTH OBTAINED:');
      _log(
        '    - AccessToken: ${googleAuth.accessToken != null ? "YES" : "NULL"}',
      );
      _log('    - IDToken: ${googleAuth.idToken != null ? "YES" : "NULL"}');

      if (googleAuth.idToken == null) {
        _log('[2] ERROR: Google ID Token is null!');
        return AuthResult.error(
          message:
              'Gagal mendapatkan Google ID Token. Pastikan SHA-1 sudah dikonfigurasi di Firebase Console.',
        );
      }

      // 3. Create Credential for Firebase
      _log('[3] Creating Firebase credential...');
      final credential = GoogleAuthProvider.credential(
        accessToken: googleAuth.accessToken,
        idToken: googleAuth.idToken,
      );

      // 4. Sign-in to Firebase
      _log('[4] SIGNING IN TO FIREBASE...');
      final UserCredential userCredential = await FirebaseAuth.instance
          .signInWithCredential(credential);
      _log('[4] FIREBASE SIGN IN SUCCESS: ${userCredential.user?.uid}');
      _log('    - Email: ${userCredential.user?.email}');
      _log('    - Display Name: ${userCredential.user?.displayName}');

      _log('[5] Getting Firebase ID Token...');
      final idToken = await userCredential.user?.getIdToken();

      if (idToken == null) {
        _log('[5] ERROR: FIREBASE ID TOKEN IS NULL');
        return AuthResult.error(message: 'Gagal mendapatkan Firebase ID Token');
      }
      _log('[5] FIREBASE ID TOKEN OBTAINED (length: ${idToken.length})');

      // 6. Send Token to Backend
      _log('[6] POSTING TO BACKEND: /auth/firebase-login');
      _log('    - Base URL: ${ApiConfig.baseUrl}');

      final response = await _apiClient.post(
        '/auth/firebase-login',
        data: {'token': idToken},
      );
      _log('[6] BACKEND RESPONSE: ${response.statusCode}');
      _log('[6] RESPONSE DATA: ${response.data}');

      if (response.statusCode == 200) {
        final responseData = response.data['data'];
        final token = responseData['token'];
        final user = User.fromJson(responseData['user']);

        await _apiClient.saveToken(token);
        _log('[7] TOKEN SAVED - Login Success!');

        return AuthResult.success(user: user, token: token);
      }

      _log('[6] ERROR: Unexpected response status');
      return AuthResult.error(
        message: response.data['message'] ?? 'Login Backend failed',
      );
    } on DioException catch (e) {
      _log('=== DIO ERROR ===');
      _log('Type: ${e.type}');
      _log('Message: ${e.message}');
      _log('Response: ${e.response?.data}');

      String errorMessage = 'Network error';
      if (e.response?.data != null && e.response?.data['message'] != null) {
        errorMessage = e.response!.data['message'];
      } else if (e.type == DioExceptionType.connectionTimeout) {
        errorMessage = 'Connection timeout';
      } else if (e.type == DioExceptionType.connectionError) {
        errorMessage = 'Cannot connect to server';
      }

      return AuthResult.error(message: errorMessage);
    } on FirebaseAuthException catch (e) {
      _log('=== FIREBASE AUTH ERROR ===');
      _log('Code: ${e.code}');
      _log('Message: ${e.message}');
      return AuthResult.error(message: 'Firebase Error: ${e.message}');
    } catch (e, stackTrace) {
      _log('=== GENERAL ERROR ===');
      _log('Error: $e');
      _log('StackTrace: $stackTrace');
      return AuthResult.error(message: e.toString());
    }
  }
}

class AuthResult {
  final bool isSuccess;
  final User? user;
  final String? token;
  final String? message;

  AuthResult._({required this.isSuccess, this.user, this.token, this.message});

  factory AuthResult.success({required User user, required String token}) {
    return AuthResult._(isSuccess: true, user: user, token: token);
  }

  factory AuthResult.error({required String message}) {
    return AuthResult._(isSuccess: false, message: message);
  }
}

class UpdateProfileResult {
  final bool isSuccess;
  final User? user;
  final String? message;

  UpdateProfileResult._({required this.isSuccess, this.user, this.message});

  factory UpdateProfileResult.success({required User user}) {
    return UpdateProfileResult._(isSuccess: true, user: user);
  }

  factory UpdateProfileResult.error({required String message}) {
    return UpdateProfileResult._(isSuccess: false, message: message);
  }
}

// Singleton
final authRepository = AuthRepository();
