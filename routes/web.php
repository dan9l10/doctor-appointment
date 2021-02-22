<?php

use App\Http\Controllers\Hospital\Admin\UserController;
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
    return view('welcome');
});

Route::prefix('hospital/admin')->group(function () {
    Route::group(['middleware'=>['role:admin']],function (){
        Route::resource('users',UserController::class)->except('show')->names('users.admin');
    });
});


Route::view('home', 'home')->middleware('auth');
