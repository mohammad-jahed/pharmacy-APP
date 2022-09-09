<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use carbon\carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        if (auth()->user()){
        auth()->user()->assignRole('Admin');
        }
        return view('dashboard');
    }

    public function test(): Factory|View|Application
    {
        //toastr()->success('Success Message');
        //return view('empty');
        $t=carbon::createFromTime(10,30,30)->day;
        dd($t);
    }
}
