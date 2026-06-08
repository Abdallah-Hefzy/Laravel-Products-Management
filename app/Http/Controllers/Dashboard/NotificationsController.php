<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function read($id){

    $notifications = Auth::user()->notifications()->findOrFail($id);

    $notifications->markAsRead();

    return redirect($notifications->data['url']);

    }
}
