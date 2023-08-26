<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationInvoicesController extends Controller
{
    public function index()
    {
        return view('notifications.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($invId)
    {

        $target_invoiceId = $invId;
        $target_userId = userID();

        $notif = DB::table('notifications')
            ->where('notifiable_id',$target_userId)
            ->where("data->invoiceId",$target_invoiceId)
            ->update([
                'read_at' => now(),
            ]);

        return redirect()->route('invoicesDetails.getDetails',$invId);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        DB::table('notifications')->where("id",$id)->delete();
        return redirect()->back();
    }

    public function readAll() {

        Auth::User()->unreadNotifications->markAsRead();

        return redirect()->back();
    }

    public function deleteAll() {

        foreach (Auth::User()->notifications as $notification)
            $notification->delete();

        return redirect()->back();
    }



}
