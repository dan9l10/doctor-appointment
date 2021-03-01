<?php


use App\Http\Controllers\Hospital\Admin\HomeController;
use App\Http\Controllers\Hospital\Admin\UserController;
use App\Http\Controllers\Hospital\User\ProfileController;
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
    return view('hospital.index');
})->name('root');


Route::prefix('hospital/admin')->group(function () {
    Route::group(['middleware'=>['role:admin']],function (){
        Route::resource('users',UserController::class)->except('show')->names('users.admin');
        Route::get('/panel', [HomeController::class,'index'])->name('admin.panel');
    });
});

Route::get('/hospital/profile/{id}',[ProfileController::class,'index'])->name('user.profile')->middleware('auth');
//Route::get('/appointment/user/{id}',[ProfileController::class,'index'])->name('user.profile')->middleware('auth');

//Route::view('/appointment','hospital.appointment.index')->middleware('auth')->name('patient.appointment');

Route::view('home', 'home')->middleware('auth');
