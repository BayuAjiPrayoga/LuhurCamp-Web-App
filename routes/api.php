<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KavlingController;
use App\Http\Controllers\Api\PeralatanController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\WeatherController;
use App\Http\Controllers\Api\V1\FCMTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group.
|
*/

// API Version 1
Route::prefix('v1')->group(function () {

    // ========================
    // Authentication
    // ========================
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/auth/firebase-login', [AuthController::class, 'firebaseLogin']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);
        Route::put('/user', [AuthController::class, 'updateProfile']);
        Route::post('/user/avatar', [AuthController::class, 'updateAvatar']);
        Route::post('/user/change-password', [AuthController::class, 'changePassword']);
    });

    // ========================
    // Public Routes (Read Only)
    // ========================
    Route::get('/kavlings', [KavlingController::class, 'index']);
    Route::get('/kavlings/{kavling}', [KavlingController::class, 'show']);

    Route::get('/peralatan', [PeralatanController::class, 'index']);
    Route::get('/peralatan/{peralatan}', [PeralatanController::class, 'show']);

    Route::get('/announcements', [AnnouncementController::class, 'index']);
    Route::get('/weather', [WeatherController::class, 'current']);

    // Debug Endpoint
    Route::get('/health', function () {
        try {
            \Illuminate\Support\Facades\DB::connection()->getPdo();
            
            // Check if fcm_token column exists
            $hasFcmColumn = \Illuminate\Support\Facades\Schema::hasColumn('users', 'fcm_token');
            
            return response()->json([
                'status' => 'ok',
                'database' => 'connected',
                'fcm_column_exists' => $hasFcmColumn,
                'version' => 'debug-v3-' . now()->timestamp,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'database' => $e->getMessage(),
                'version' => 'debug-v3-' . now()->timestamp,
            ], 500);
        }
    });

    // Test FCM Notification Endpoint
    Route::post('/test-fcm', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $user = \App\Models\User::find($request->user_id);
        
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
        
        if (!$user->fcm_token) {
            return response()->json([
                'success' => false, 
                'message' => 'User has no FCM token',
                'user' => $user->name
            ], 400);
        }

        $fcmService = new \App\Services\FCMService();
        $result = $fcmService->sendToDevice(
            $user->fcm_token,
            $request->title,
            $request->body,
            ['type' => 'test', 'timestamp' => now()->toISOString()]
        );

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Notification sent!' : 'Failed to send notification',
            'user' => $user->name,
            'fcm_token' => substr($user->fcm_token, 0, 30) . '...',
        ]);
    });

    // Test FCM Topic Notification
    Route::post('/test-fcm-topic', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'topic' => 'required|string',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $fcmService = new \App\Services\FCMService();
        $result = $fcmService->sendToTopic(
            $request->topic,
            $request->title,
            $request->body,
            ['type' => 'test_topic', 'timestamp' => now()->toISOString()]
        );

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Topic notification sent!' : 'Failed to send',
            'topic' => $request->topic,
        ]);
    });

    Route::get('/galleries', [GalleryController::class, 'index']);

    // ========================
    // Protected Routes (Auth Required)
    // ========================
    Route::middleware('auth:sanctum')->group(function () {
        // FCM Token
        Route::put('/user/fcm-token', [FCMTokenController::class, 'update']);
        Route::delete('/user/fcm-token', [FCMTokenController::class, 'destroy']);

        // Bookings
        Route::get('/bookings', [BookingController::class, 'index']);
        Route::post('/bookings', [BookingController::class, 'store']);
        Route::get('/bookings/{booking}', [BookingController::class, 'show']);
        Route::post('/bookings/{booking}/upload-payment', [BookingController::class, 'uploadPayment']);
        Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel']);

        // Gallery upload
        Route::post('/galleries', [GalleryController::class, 'store']);
    });
});
