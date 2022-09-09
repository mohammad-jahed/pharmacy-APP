<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        auth()->user()->unreadNotifications->markAsRead();

        return view('pages.Notifications.notifications', [
            'notifications' => auth()->user()->notifications()->paginate(5)
        ]);
    }

    public function unreadNotifications(): JsonResponse
    {
        $user = auth()->user();
        $notifications = $user->unreadNotifications;
        return self::getJsonResponse($notifications,'notification');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Notification $notification
     * @return Application|Factory|View
     */
    public function show(Notification $notification): View|Factory|Application
    {
        $not1 = $notification;
        //$d=auth()->user()->notifications;

        //dd($not1);
        return view('pages.Notifications.notification', compact('not1'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Notification $notification
     * @return Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    /*public function destroy($id): Response//Notification $notification)
    {
        auth()->user()->unreadNotifications->where($id)
            ->markAsRead();
    }*/

    public function sendPrescriptionNotification()
    {
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

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
