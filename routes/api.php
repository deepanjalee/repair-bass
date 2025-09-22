<?php

use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Customer\QuotationController;
use App\Http\Controllers\InvoiceController;
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
    Route::post('/quotation/expenses/delete', [QuotationController::class, 'deleteExpense']);
    Route::post('/quotation/items/delete', [QuotationController::class, 'deleteItem']);
    Route::post('/quotations', [QuotationController::class, 'store']);
    Route::post('/invoice/expenses/delete', [InvoiceController::class, 'deleteExpense']);
    Route::post('/invoice/items/delete', [QuotationController::class, 'deleteItem']);
    Route::post('/invoices', [InvoiceController::class, 'store']);
});
Route::get('/admin/customer/sites/{customer_id}', [SiteController::class, 'getSitesByCustomerId']);
