<?php


use App\Http\Controllers\Hospital\Admin\HomeController;
use App\Http\Controllers\Hospital\Admin\UserController;
use App\Http\Controllers\Hospital\AppointmentController;
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

Route::get('/', function () {
    return view('hospital.index');
})->name('root');

//admin-panel
Route::prefix('/admin')->group(function () {
    Route::group(['middleware'=>['role:admin']],function (){
        Route::resource('/users',UserController::class)->except('show')->names('users.admin');
        Route::get('/panel', [HomeController::class,'index'])->name('admin.panel');
    });
});

//show user profile
Route::group(['middleware'=>'auth'],function (){
    Route::get('/hospital/profile/{id}',[ProfileController::class,'index'])->name('user.profile');//->middleware('auth');
    Route::post('/meet/{id_doc}',[MeetController::class,'store'])->name('meet.create');
    Route::get('/appointments/{id}',[AppointmentController::class,'index'])->name('appointment.index');
});

//for show doctors and appointments
Route::prefix('/hospital')->group(function () {
    Route::get('/doctors',[DoctorController::class,'index'])->name('doctors.show');
});

//for ajax to get time
Route::get('/time',[AppointmentController::class,'returnAppointmentsTime'])->name('time.update');


