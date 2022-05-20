<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\States\CityStoreRequest;
use App\Http\Requests\States\StateUpdateRequest;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $states=State::all();
        return view('pages.States.states',compact('states'));
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
    public function store(CityStoreRequest $request)
    {

        $data = $request->validated();
        $state=State::query()->create($data);
        toastr()->success(trans('messages.success'));
        return redirect()->route('states.index');
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
    public function update(StateUpdateRequest $request,State $state)
    {
        $data = $request->validated();
        $state=State::query()->findOrFail($state->id)->update($data);
        toastr()->success(trans('messages.success'));
        return redirect()->route('states.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(State $state)
    {
        $states = $state->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('states.index');
    }
}
