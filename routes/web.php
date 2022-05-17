<?php

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\WorkTimeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });

});


//==============================Translate all pages============================
Route::group(
    [
        'prefix' => (new Mcamara\LaravelLocalization\LaravelLocalization)->setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {

    //==============================dashboard============================
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/aaaa', 'HomeController@test')->name('test');
    //================================pharmacy===================================================

    Route::resource('/pharmacy' ,'Admin\pharmacyController');
    Route::get('/state/{state}/cities',[StateController::class,'cities'])->name('state.cities');
    Route::get('/city/{city}/areas',[CityController::class,'areas'])->name('city.areas');
    Route::get('/days',[WorkTimeController::class,'days'])->name('days');
    });
