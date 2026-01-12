<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\ApnsConfig;
use Illuminate\Support\Facades\Log;

class FCMService
{
    protected $messaging;

    public function __construct()
    {
        // Try environment variable first (for Railway/production)
        $credentialsJson = env('FIREBASE_CREDENTIALS');

        if ($credentialsJson) {
            // Check if it's a file path
            if (str_starts_with($credentialsJson, 'storage/') || str_starts_with($credentialsJson, '/') || str_ends_with($credentialsJson, '.json')) {
                // If it looks like a path but isn't absolute, assume relative to base path
                $path = str_starts_with($credentialsJson, '/') ? $credentialsJson : base_path($credentialsJson);

                if (file_exists($path)) {
                    $factory = (new Factory)->withServiceAccount($path);
                    $this->messaging = $factory->createMessaging();
                    return;
                }
            }

            // Try parsing as JSON
            try {
                $credentials = json_decode($credentialsJson, true);
                if (is_array($credentials)) {
                    $factory = (new Factory)->withServiceAccount($credentials);
                    $this->messaging = $factory->createMessaging();
                    return;
                }
            } catch (\Exception $e) {
                Log::error('FCM: Failed to parse FIREBASE_CREDENTIALS env: ' . $e->getMessage());
            }
        }

        // Fallback to file (for local development)
        $credentialsPath = storage_path('app/firebase_credentials.json');

        if (file_exists($credentialsPath)) {
            $factory = (new Factory)->withServiceAccount($credentialsPath);
            $this->messaging = $factory->createMessaging();
        } else {
            Log::warning('Firebase credentials not found (neither env nor file)');
        }
    }

    /**
     * Send notification to a single device
     */
    public function sendToDevice(string $fcmToken, string $title, string $body, array $data = []): bool
    {
        if (!$this->messaging || empty($fcmToken)) {
            Log::warning('FCM: Cannot send notification - messaging not initialized or empty token');
            return false;
        }

        try {
            $message = CloudMessage::fromArray([
                'token' => $fcmToken,
                'notification' => ['title' => $title, 'body' => $body],
                'data' => $data,
            ])
                ->withAndroidConfig($this->getAndroidConfig())
                ->withApnsConfig($this->getApnsConfig());

            $this->messaging->send($message);

            Log::info("FCM: Notification sent to device", [
                'title' => $title,
                'token' => substr($fcmToken, 0, 20) . '...'
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('FCM: Failed to send notification', [
                'error' => $e->getMessage(),
                'token' => substr($fcmToken, 0, 20) . '...'
            ]);
            return false;
        }
    }

    /**
     * Send notification to multiple devices
     */
    public function sendToDevices(array $fcmTokens, string $title, string $body, array $data = []): array
    {
        if (!$this->messaging || empty($fcmTokens)) {
            return ['success' => 0, 'failure' => count($fcmTokens)];
        }

        $validTokens = array_filter($fcmTokens, fn($token) => !empty($token));

        if (empty($validTokens)) {
            return ['success' => 0, 'failure' => 0];
        }

        try {
            $message = CloudMessage::new()
                ->withNotification(Notification::create($title, $body))
                ->withData($data)
                ->withAndroidConfig($this->getAndroidConfig())
                ->withApnsConfig($this->getApnsConfig());

            $report = $this->messaging->sendMulticast($message, $validTokens);

            Log::info("FCM: Multicast sent", [
                'success' => $report->successes()->count(),
                'failure' => $report->failures()->count()
            ]);

            return [
                'success' => $report->successes()->count(),
                'failure' => $report->failures()->count()
            ];
        } catch (\Exception $e) {
            Log::error('FCM: Failed to send multicast', ['error' => $e->getMessage()]);
            return ['success' => 0, 'failure' => count($validTokens)];
        }
    }

    /**
     * Send notification to a topic
     */
    public function sendToTopic(string $topic, string $title, string $body, array $data = []): bool
    {
        if (!$this->messaging) {
            return false;
        }

        try {
            $message = CloudMessage::fromArray([
                'topic' => $topic,
                'notification' => ['title' => $title, 'body' => $body],
                'data' => $data,
            ])
                ->withAndroidConfig($this->getAndroidConfig())
                ->withApnsConfig($this->getApnsConfig());

            $this->messaging->send($message);

            Log::info("FCM: Notification sent to topic", [
                'topic' => $topic,
                'title' => $title
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('FCM: Failed to send to topic', [
                'topic' => $topic,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Android specific configuration
     */
    protected function getAndroidConfig(): AndroidConfig
    {
        return AndroidConfig::fromArray([
            'priority' => 'high',
            'notification' => [
                'channel_id' => 'luhurcamp_alert_channel', // Updated to match Flutter custom channel
                'sound' => 'luhur_alert', // Must not have extension for Android
            ],
        ]);
    }

    /**
     * iOS specific configuration
     */
    protected function getApnsConfig(): ApnsConfig
    {
        return ApnsConfig::fromArray([
            'headers' => [
                'apns-priority' => '10',
            ],
            'payload' => [
                'aps' => [
                    'sound' => 'luhur_alert.aiff', // Or .wav, must exist in iOS bundle
                    'badge' => 1,
                ],
            ],
        ]);
    }
}
