<?php

use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Customer\QuotationController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', function () {
    return view('auth.login');
})->middleware(['auth']);

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/main_layout', function () {
            return view('layouts.main_layout');
        });

        Route::resource('users', UserController::class);
        Route::get('/items/pdf', [ItemController::class,'downloadPdf']);
        Route::resource('items', ItemController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('sites', SiteController::class);
    });
    Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
        Route::resource('quotations', QuotationController::class);
    });
});
