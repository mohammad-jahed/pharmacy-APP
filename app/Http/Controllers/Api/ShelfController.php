<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\shelf;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\shelf  $shelf
     * @return \Illuminate\Http\Response
     */
    public function show(shelf $shelf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shelf  $shelf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, shelf $shelf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shelf  $shelf
     * @return \Illuminate\Http\Response
     */
    public function destroy(shelf $shelf)
    {
        //
    }
}
