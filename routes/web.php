<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\BeAuthorRequestsController;
use App\Http\Controllers\Web\CategoryController;

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
        Route::resource('/categories', CategoryController::class);
        Route::group(['prefix' => 'requests', 'controller' => BeAuthorRequestsController::class], function(){
            Route::get('/', 'index')->name('requests.index');
            Route::get('/done', 'indexDone')->name('requests.indexDone');
            Route::get('/{id}', 'show')->name('requests.show');
            Route::get('/reject/{id}', 'reject')->name('requests.reject');
            Route::get('/accept/{id}', 'accept')->name('requests.accept');
        });
    });
});
