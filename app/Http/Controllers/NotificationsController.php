<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NotificationEvent;
use App\Models\Notification;
use App\Models\User;

class NotificationsController extends Controller
{
	public function notification($title, $message) {
		$user = User::find(1);

		Notification::create([
			'title' => $title,
			'message' => $message,
			'read' => false,
			'user_id' => $user->id
		]);

		event(
			new NotificationEvent($title, $message, $user)
		);
	}
}
