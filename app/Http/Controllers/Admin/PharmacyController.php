<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        auth()->user()->can('add pharmacy');

        $role = Role::query()->where('name', 'like', 'Pharmacy')->get();
        $pharmacies = (new User)->role($role)->get();

        return view('pages.pharmacy.pharmacy', compact('pharmacies'));
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
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $file_name = null;
        if ($request->hasFile('imagePath')) {
            $request->file('imagePath')->store('public/images');
            $file_name = $request->file('imagePath')->hashName();
        }
        $data['imagePath'] = $file_name;
        $data['password'] = Hash::make($data['password']);
        $user = User::query()->create($data);

        ////////////////////giving role to the pharmacy//////////////////////////////////////////////////////////
        $role = Role::query()->where('name', 'like', 'Pharmacy')->get();
        $user->assignRole($role);

//////////////////////////giving permissions to the pharmacy/////////////////////////////////////////////////
        $p1 = Permission::query()->where('name', 'like', 'add shelf')->get();
        $p2 = Permission::query()->where('name', 'like', 'update shelf')->get();
        $p3 = Permission::query()->where('name', 'like', 'delete shelf')->get();
        $p4 = Permission::query()->where('name', 'like', 'add medicine')->get();
        $p5 = Permission::query()->where('name', 'like', 'add address')->get();
        $p6 = Permission::query()->where('name', 'like', 'update address')->get();
        $p7 = Permission::query()->where('name', 'like', 'delete address')->get();
        $p8 = Permission::query()->where('name', 'like', 'add work_time')->get();
        $p9 = Permission::query()->where('name', 'like', 'update work_time')->get();
        $p10 = Permission::query()->where('name', 'like', 'delete work_time')->get();
        $p11 = Permission::query()->where('name', 'like', 'add component')->get();
        $p12 = Permission::query()->where('name', 'like', 'update component')->get();
        $p13 = Permission::query()->where('name', 'like', 'delete component')->get();
        $p14 = Permission::query()->where('name', 'like', 'add material')->get();
        $p15 = Permission::query()->where('name', 'like', 'update material')->get();
        $p16 = Permission::query()->where('name', 'like', 'delete material')->get();

        $user->givePermissionTo($p1);
        $user->givePermissionTo($p2);
        $user->givePermissionTo($p3);
        $user->givePermissionTo($p4);
        $user->givePermissionTo($p5);
        $user->givePermissionTo($p6);
        $user->givePermissionTo($p7);
        $user->givePermissionTo($p8);
        $user->givePermissionTo($p9);
        $user->givePermissionTo($p10);
        $user->givePermissionTo($p11);
        $user->givePermissionTo($p12);
        $user->givePermissionTo($p13);
        $user->givePermissionTo($p14);
        $user->givePermissionTo($p15);
        $user->givePermissionTo($p16);

        toastr()->success(trans('messages.success'));
        return redirect()->route('pharmacy.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $pharmacies = User::query()->findOrFail($id)->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('pharmacy.index',compact('pharmacies'));
    }
}
