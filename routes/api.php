<?php

use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Customer\QuotationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware(['auth:sanctum'])->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::post('/users', [UserController::class, 'store']);
    });

});

Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::post('/quotations', [QuotationController::class, 'store']);
});
Route::get('/admin/customer/sites/{customer_id}', [SiteController::class, 'getSitesByCustomerId']);
