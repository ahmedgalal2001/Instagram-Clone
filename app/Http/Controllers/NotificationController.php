<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Expectation;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $notifies = Notification::with('sender', 'receiver')
                ->where('reciverId', Auth::id())
                ->get();
            $hasUnseenNotifications = $notifies->contains('seen', false);
            $time_notify = $notifies->map(function ($notify) {
                $timestamp = $notify->created_at;
                $now = Carbon::now();

                $diffInMinutes = $timestamp->diffInMinutes($now);
                $diffInHours = $timestamp->diffInHours($now);

                if ($diffInMinutes < 60) {
                    return $diffInMinutes . ' minutes ago';
                } elseif ($diffInHours < 24) {
                    return $diffInHours . ' hours ago';
                } else {
                    return $timestamp->format('j M Y');
                }
            });
            return response()->json([
                'message' => 'Notifications retrieved successfully',
                'notifies' => $notifies,
                'hasUnseenNotifications' => $hasUnseenNotifications,
                'time_notify' => $time_notify
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        try {
            Notification::where('reciverId', Auth::id())->update(['seen' => true]);
            return response()->json([
                'message' => 'Notifications marked as seen successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
