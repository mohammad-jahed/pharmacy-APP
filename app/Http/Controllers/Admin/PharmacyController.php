<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\PharmacyUpdateRequest;
use App\Http\Requests\Users\RegisterRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use App\Models\WorkTime;
use GuzzleHttp\Psr7\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

use Spatie\Permission\Models\Role;

class PharmacyController extends Controller
{

    /**
     * @throws AuthorizationException
     */
    public function index(): View|Factory|Application
    {
        $this->authorize('view', new User());
        $states = State::all();
        $pharmacies = User::type('Pharmacy')->get();
        return view('pages.pharmacy.pharmacy', compact('pharmacies'))
            ->with('states', $states);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $this->authorize('create', new User());
        $data = $request->validated();
        $file_name = null;
        if ($request->hasFile('imagePath')) {
            $request->file('imagePath')->store('public/images');
            $file_name = $request->file('imagePath')->hashName();
        }
        $data['imagePath'] = $file_name;
        $user = User::query()->create($data);
        $data['user_id'] = $user->id;
        Address::query()->create($data);
        WorkTime::query()->create($data);
        ////////////////////giving role to the pharmacy//////////////////////////////////////////////////////////
        $role = Role::query()->where('name', 'like', 'Pharmacy')->get();
        $user->assignRole($role);
        toastr()->success(trans('messages.success'));
        return redirect()->route('pharmacy.index');
    }

    /*public function cities(Request $request)
    {
        $cities = City::query()->findOrFail($request->get('state_id'));
        return view('pages.pharmacy.pharmacy',compact('cities'));

    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param PharmacyUpdateRequest $request
     * @param User $pharmacy
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(PharmacyUpdateRequest $request, User $pharmacy): JsonResponse
    {
        $this->authorize('update', $pharmacy);
        $data = $request->validated();
        $file_name = null;
        if ($request->hasFile('imagePath')) {
            $request->file('imagePath')->store('public/images');
            $file_name = $request->file('imagePath')->hashName();
        }
        $data['imagePath'] = $file_name;
        $user = $pharmacy->update($data);
        Address::query()->update($data);
        WorkTime::query()->update($data);
        $response = [
            'user' => $user,
            'message' => 'Information Updated Successfully'
        ];
        return response()->json($response);
    }


    public function destroy(User $pharmacy): RedirectResponse
    {
        $pharmacies = $pharmacy->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('pharmacy.index', compact('pharmacies'));
    }
}
