<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FCMTokenController extends Controller
{
    /**
     * Update FCM token for authenticated user
     */
    public function update(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string|max:255',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update(['fcm_token' => $request->fcm_token]);

        return response()->json([
            'success' => true,
            'message' => 'FCM token updated successfully',
        ]);
    }

    /**
     * Remove FCM token (on logout)
     */
    public function destroy()
    {
        /** @var User $user */
        $user = Auth::user();
        $user->update(['fcm_token' => null]);

        return response()->json([
            'success' => true,
            'message' => 'FCM token removed successfully',
        ]);
    }
}
