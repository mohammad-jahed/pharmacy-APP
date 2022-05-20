<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Areaes\AreaStoreRequest;
use App\Http\Requests\Areaes\AreaUpdateRequest;
use App\Models\Area;
use App\Models\City;


class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $areaes=Area::all();
        $cities=City::all();
        return view('pages.Areaes.areaes',compact('areaes','cities'));
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
    public function store(AreaStoreRequest $request): \Illuminate\Http\RedirectResponse
    {

        $data = $request->validated();
        Area::query()->create($data);
        toastr()->success(trans('messages.success'));
        return redirect()->route('areaes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(AreaUpdateRequest $request, int $id): \Illuminate\Http\RedirectResponse//Area $area)
    {
        $data = $request->validated();
        Area::query()->findOrFail($id)->update($data);
        toastr()->success(trans('messages.success'));
        return redirect()->route('areaes.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {

         Area::query()->findOrFail($id)->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('areaes.index');
    }
}
