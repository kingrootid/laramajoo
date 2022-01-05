<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\MasterController;
use App\Models\Product;
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

Route::get('/', function () {
    $data = [
        'page' => 'Home',
        'product' => Product::all()
    ];
    return view('dashboard', $data);
});
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('master/category', [MasterController::class, 'category']);
    Route::get('master/product', [MasterController::class, 'product']);
});
Route::group(['prefix' => 'data', 'as' => 'data.'], function () {
    Route::get('category', [DataController::class, 'category']);
    Route::get('category/{id}', [DataController::class, 'getCategory']);
    Route::get('product', [DataController::class, 'product']);
    Route::get('product/{id}', [DataController::class, 'getProduct']);
});
Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
    Route::post('category', [AjaxController::class, 'category']);
    Route::post('product', [AjaxController::class, 'product']);
});
Route::post('register', [AuthController::class, 'store']);
Route::post('login', [AuthController::class, 'authenticate']);
Route::get('app/login', [AuthController::class, 'login'])->name('login');
Route::get('app/logout', [AuthController::class, 'logout']);
Route::get('app/register', [AuthController::class, 'register'])->name('register');
