<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        auth()->user()->unreadnotifications->markAsRead();

        return view('pages.Notifications.notifications',[
            'notifications' => auth()->user()->notifications()->paginate(5)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        $not1=$notification;
        //$d=auth()->user()->notifications;

        //dd($not1);
        return view('pages.Notifications.notification',compact('not1'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//Notification $notification)
    {
        auth()->user()->unreadnotifications->where($id)
            ->markAsRead();
    }

    public function sendPrescriptionNotification(){
        $admin = User::type('Admin')->first();

        $prescriptionData = [
            'name' => 'BOGO',
            'body' => 'You received a new prescription.',
            'thanks' => 'Thank you',
            'prescriptionText' => 'Check out the prescr',
            'prescriptionUrl' => url('/'),
            'prescription_id' => 007
        ];
    }

    public function markAllAsRead(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
