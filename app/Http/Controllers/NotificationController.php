<?php

namespace App\Http\Controllers;

use App\Events\PostReviewEvent;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('jwt');
    }
    public function index()
    {
        
        // return [
            broadcast(new PostReviewEvent(1, 1))->toOthers();
            // 'read' => NotificationResource::collection(Auth::user()->readNotifications),
            // 'unread' => NotificationResource::collection(Auth::user()->unreadNotifications)
        // ];
    }
    public function markRead(Request $request)
    {
        \Auth::user()->unreadNotifications()->find($request->id)->MarkAsRead();
    }
}
