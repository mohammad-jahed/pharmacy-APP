<?php

use App\Http\Controllers\Admin\PharmacyController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\MedicineController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\UserController;
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
    Route::apiResource('/periods', 'Api\PeriodController');
    Route::apiResource('/reservations', 'Api\ReservationController');
    Route::apiResource('/materials', 'Api\MaterialController');
    Route::apiResource('/prescriptions', 'Api\PrescriptionController');
    Route::get('/pharmacies',[PharmacyController::class,'allPharmacies']);
    Route::get('/states/{state}',[\App\Http\Controllers\Admin\StateController::class,'show']);
    Route::get('/cities/{city}',[\App\Http\Controllers\Admin\CityController::class,'show']);
    Route::get('/areas/{area}',[\App\Http\Controllers\Admin\AreaController::class,'show']);


    Route::get('/users/medicines', [PharmacyController::class, 'medicines']);
    Route::get('/states', [StateController::class, 'allStates']);
    Route::get('/state/{state}/cities',[StateController::class,'cities'])->name('state.cities');
    Route::get('/city/{city}/areas',[CityController::class,'areas'])->name('city.areas');
    Route::get('/medicines/alternative/{medicine}', [MedicineController::class, 'alternatives']);
    Route::get('/medicines/{medicine}/materials', [MedicineController::class, 'materials']);
    Route::get('/medicines/{medicine}/pharmacies', [MedicineController::class, 'pharmacies']);
    Route::get('/medicines/{medicine}/shelves', [MedicineController::class, 'shelves']);
    Route::post('/medicines/pharmacies', [MedicineController::class, 'getPharmacies']);
    Route::post('/medicines/filter', [MedicineController::class, 'medicineFilter']);
    Route::put('/users/{user}',[UserController::class,'update']);
    Route::get('/expired',[MedicineController::class,'expiredMedicines']);
    Route::get('/displayed',[MedicineController::class,'displayedMedicines']);
    Route::post('/medicines/alternatives', [MedicineController::class, 'alternatives']);
    Route::get('/materials/{material}/medicines', [MaterialController::class, 'medicines']);
    Route::get('/users/reservations', [ReservationController::class, 'userReservations']);
    Route::get('/pharmacies/reservations', [ReservationController::class, 'pharmacyReservations']);
    Route::post('/pharmacies/nearest', [UserController::class, 'theNearestPharmacies']);
    Route::post('/pharmacies/filter', [PharmacyController::class, 'pharmacyFilter']);
    Route::post('/users/filter', [UserController::class, 'userFilter']);


});




//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
