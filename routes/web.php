<?php

use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\RoleController;

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

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::middleware('dashboard')->group(function () {
        Route::get('/', function(){return redirect()->route('user.index');});
        Route::resource('/user', UserController::class);
        Route::resources(['roles' => RoleController::class]);
    });
});
