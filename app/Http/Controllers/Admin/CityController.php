<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cities\CityUpdateRequest;
use App\Http\Requests\Cities\CityStoreRequest;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $cities=City::all();
        $states=State::all();
        return view('pages.Cities.cities',compact('cities','states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CityStoreRequest $request): \Illuminate\Http\RedirectResponse
    {

        $data = $request->validated();
        City::query()->create($data);
        toastr()->success(trans('messages.success'));
        return redirect()->route('cities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(City $city): JsonResponse
    {
        //
        return self::getJsonResponse($city,'state');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CityUpdateRequest $request,City $city): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        City::query()->findOrFail($city->id)->update($data);
        toastr()->success(trans('messages.success'));
        return redirect()->route('cities.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(City $city): \Illuminate\Http\RedirectResponse
    {
         $city->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('cities.index');
    }
}
