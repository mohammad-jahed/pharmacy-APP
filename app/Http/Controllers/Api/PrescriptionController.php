<?php

namespace App\Http\Controllers\Api;

use App\Events\Prescription\PrescriptionCreateEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Prescriptions\PrescriptionStoreRequest;
use App\Http\Requests\Prescriptions\PrescriptionUpdateRequest;
use App\Models\Prescription;
use App\Models\User;
use App\Notifications\PrescriptionNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        //
        $prescriptions = Prescription::all();
        $admin = User::type('Admin')->first();
        dd($admin->notifications);
        return view('pages.Notifications.prescription',compact('prescriptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PrescriptionStoreRequest $request
     * @return JsonResponse
     */
    public function store(PrescriptionStoreRequest $request)
    {
        //
        /**
         * @var Prescription $prescription;
         */

        $data = $request->validated();
        $request->file('imagePath')->store('public/images');
        $file_name = $request->file('imagePath')->hashName();
        $data['imagePath'] = $file_name;
        $data['user_id'] = auth('api')->user()->getAuthIdentifier();
        $prescription = Prescription::query()->create($data);
        $admin = User::type('Admin')->first();
        $prescriptionData = [
            'body' => 'You received a new prescription.',
            'thanks' => 'Thank you',
            'prescriptionText' => $prescription->imagePath,
            'prescriptionUrl' => url('/'),
            'prescription_id' => $prescription->id
        ];
        Notification::send($admin, new PrescriptionNotification($prescriptionData));
        event(new PrescriptionCreateEvent($prescription));
        return $this->getJsonResponse($prescription,'Prescription Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param Prescription $prescription
     * @return JsonResponse
     */
    public function show(Prescription $prescription)
    {
        //
        return $this->getJsonResponse($prescription,'prescription');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PrescriptionUpdateRequest $request
     * @param Prescription $prescription
     * @return JsonResponse
     */
    public function update(PrescriptionUpdateRequest $request, Prescription $prescription)
    {
        //
        $data = $request->validated();
        $prescription->update($data);
        return $this->getJsonResponse($prescription,'Prescription Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Prescription $prescription
     * @return JsonResponse
     */
    public function destroy(Prescription $prescription)
    {
        //
        $prescription->delete();
        return $this->getJsonResponse($prescription,'Prescription deleted successfully');
    }
}
