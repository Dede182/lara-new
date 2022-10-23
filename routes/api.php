<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auht\ApiAuthController;
use App\Http\Controllers\Api\ContactApiController;

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

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('contact',ContactApiController::class);
    Route::post('contact/bulk',[ContactApiController::class,'bulk'])->name('api.contactbulk');
    Route::get('/logout',[ApiAuthController::class,'logout'])->name('api.logout');
});

Route::post('/register',[ApiAuthController::class,'register'])->name('api.register');
Route::post('/login',[ApiAuthController::class,'login'])->name('api.login');



