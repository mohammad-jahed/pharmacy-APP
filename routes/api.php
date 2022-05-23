<?php

use App\Http\Controllers\Admin\PharmacyController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ComponentController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\MedicineController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
Route::group([
    'middleware' => 'api',

], function () {
    Route::apiResource('/medicines', 'Api\MedicineController');
    Route::apiResource('/components', 'Api\ComponentController');
    Route::post('/components/{component}/materials', [MaterialController::class, 'store']);
    Route::get('/components/{component}', [ComponentController::class, 'materialsComponent']);
    Route::get('/medicines/alternative/{medicine}', [MedicineController::class, 'alternatives']);
    Route::get('/medicines', [PharmacyController::class, 'medicines']);
});




//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
