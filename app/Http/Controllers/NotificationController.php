<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class NotificationController extends Controller
{
    public function getNotifications() {
        $notifications = Notification::all();
        return view('admin.notifications.all', compact('notifications'));
    }

    public function getNewNotification() {
        return view('admin.notifications.create');
    }

    public function postCreateNotification() {

        $data = Input::all();
        $date = strtotime(Input::get('date'));
        $newformat = date('Y-m-d', $date);
        $data['date'] = $newformat;

        Notification::create($data);

        return back()->with('message', 'Notification set!');
    }

    public function getDeleteNotification($id) {
        Notification::find($id)->delete();

        return back()->with('message', 'Notification deleted!');
    }

    public function getEditNotification($id) {
        $notification = Notification::find($id);

        return view('admin.notifications.edit', compact('notification'));
    }

    public function postEditNotification() {
        $notification = Notification::find(Input::get('id'));

        $date = strtotime(Input::get('date'));
        $newformat = date('Y-m-d', $date);

        $notification->title = Input::get('title');
        $notification->notification = Input::get('notification');
        $notification->date = $newformat;
        $notification->update();

        return back()->with('message', 'Notification updated!');
    }
}
