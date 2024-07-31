<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//============== API CONTROLLERS =================
use App\Http\Controllers\Frontend\UserOrderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/verify-phone-pe-payment', [UserOrderController::class, 'verifyPhonePePayment'])->name('verify-phone-pe-payment');

