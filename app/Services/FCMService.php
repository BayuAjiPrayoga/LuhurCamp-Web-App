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
        $credentialsPath = storage_path('app/firebase_credentials.json');
        
        if (file_exists($credentialsPath)) {
            $factory = (new Factory)->withServiceAccount($credentialsPath);
            $this->messaging = $factory->createMessaging();
        } else {
            Log::warning('Firebase credentials file not found at: ' . $credentialsPath);
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
                'channel_id' => 'luhurcamp_channel',
                'sound' => 'default',
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
                    'sound' => 'default',
                    'badge' => 1,
                ],
            ],
        ]);
    }
}
