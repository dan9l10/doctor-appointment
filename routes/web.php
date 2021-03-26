<?php


use App\Http\Controllers\Hospital\Admin\AppointmentManagementController;
use App\Http\Controllers\Hospital\Admin\MeetsManagementController;
use App\Http\Controllers\Hospital\Admin\HomeController;
use App\Http\Controllers\Hospital\Admin\UserController;
use App\Http\Controllers\Hospital\AppointmentController;
use App\Http\Controllers\Hospital\HomePageController;
use App\Http\Controllers\Hospital\MeetController;
use App\Http\Controllers\Hospital\User\DoctorController;
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

Route::get('/',[HomePageController::class,'index'])->name('root');

//admin-panel
Route::prefix('/admin')->group(function () {
    Route::group(['middleware'=>['role:admin']],function (){
        Route::resource('/users',UserController::class)->except('show')->names('users.admin');
        Route::resource('/meets',MeetsManagementController::class)->except('show')->names('meets.admin');
        Route::resource('/appointment',AppointmentManagementController::class)->except('show')->names('appointments.admin');
        Route::get('/panel', [HomeController::class,'index'])->name('admin.panel');
    });
});

//show user profile
Route::group(['middleware'=>'auth'],function (){
    Route::get('/hospital/profile/{id}',[ProfileController::class,'index'])->name('user.profile');
    Route::resource('/hospital/profile',ProfileController::class)->except(['index','show','create'])->names('user.profile');
    Route::resource('/meet',MeetController::class)->names('meet');
    Route::post('/meet/{id_doc}',[MeetController::class,'store'])->name('meet.create');
    Route::get('/appointments/{id}',[AppointmentController::class,'index'])->name('appointment.index');
    Route::post('/avatar/upload', [ProfileController::class,'upload'])->name('avatar.user.upload');
    Route::get('/time',[AppointmentController::class,'returnAppointmentsTime'])->name('time.update');

});

//for show doctors and appointments
Route::prefix('/hospital')->group(function () {
    Route::get('/doctors',[DoctorController::class,'index'])->name('doctors.show');
});

//for ajax to use filter for doctor
Route::get('/scopeSpecial',[DoctorController::class,'scopeSpecial'])->name('doctor.update');


