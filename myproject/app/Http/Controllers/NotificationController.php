<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SystemNotification;

class NotificationController extends Controller
{
    public function markAsRead()
    {
        $user = Auth::user();
        if ($user) {
            SystemNotification::where('user_id', $user->id)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return response()->json(['success' => true]);
    }
}
