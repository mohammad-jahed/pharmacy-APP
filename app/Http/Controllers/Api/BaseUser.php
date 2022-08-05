<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Users\PharmacyUpdateRequest;
use App\Http\Requests\Users\RegisterRequest;
use App\Models\Address;
use App\Models\User;
use App\Models\WorkTime;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use function auth;
use function redirect;
use function toastr;
use function trans;

class BaseUser extends Controller
{
    //
    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $this->authorize('create', User::class);
        $data = $request->validated();
        $file_name = null;
        if ($request->hasFile('imagePath')) {
            $request->file('imagePath')->store('public/images');
            $file_name = $request->file('imagePath')->hashName();
        }
        $data['imagePath'] = $file_name;
        $user = User::query()->create($data);
        $data['user_id'] = $user->id;
        if (isset($data['state_id'])) {
            Address::query()->create($data);
        }
        if (isset($data['day'])) {
            WorkTime::query()->create($data);
        }
        ////////////////////giving role to the pharmacy//////////////////////////////////////////////////////////
        $role = Role::query()->where('name', 'like', 'Pharmacy')->get();
        $user->assignRole($role);
        toastr()->success(trans('messages.success'));
        return redirect()->route('pharmacy.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function update(PharmacyUpdateRequest $request, User $user): JsonResponse
    {
        //
        $this->authorize('update', $user);
        $data = $request->validated();
        $file_name = null;
        if ($request->hasFile('imagePath')) {
            $request->file('imagePath')->store('public/images');
            $file_name = $request->file('imagePath')->hashName();
        }
        $data['imagePath'] = $file_name;
        if(isset($data['old_password'])){
            $data['password'] = $data['new_password'];
            auth()->logout();
        }
        $data['user_id'] = $user->id;
        if(isset($data['state_id'])){
            Address::query()->update($data);
        }
        if(isset($data['day'])){
            WorkTime::query()->update($data);
        }
        $user->update($data);

        return self::getJsonResponse($user,"User Updated Successfully");
    }




}
