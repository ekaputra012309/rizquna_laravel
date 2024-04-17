<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingDetailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentDetailController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\VisaController;
use App\Http\Controllers\VisaDetailController;
use App\Http\Controllers\KursVisaController;
use App\Http\Controllers\PrivilageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// auth
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register');
    Route::post('logout', 'logout')->name('logout');
    Route::post('refresh', 'refresh')->name('refresh');
    Route::get('user-profile', 'userProfile')->name('userProfile');
    Route::get('users', 'users')->name('users');
});
// hotel
Route::controller(HotelController::class)->group(function () {
    Route::get('hotel', 'index')->name('hotel');
    Route::post('hotel', 'store');
    Route::get('hotel/{id}', 'show');
    Route::post('hotel/{id}', 'update');
    Route::delete('hotel/{id}', 'destroy');
});
// room
Route::controller(RoomController::class)->group(function () {
    Route::get('room', 'index')->name('room');
    Route::post('room', 'store');
    Route::get('room/{id}', 'show');
    Route::post('room/{id}', 'update');
    Route::delete('room/{id}', 'destroy');
});
// agent
Route::controller(AgentController::class)->group(function () {
    Route::get('agent', 'index')->name('agent');
    Route::post('agent', 'store');
    Route::get('agent/{id}', 'show');
    Route::post('agent/{id}', 'update');
    Route::delete('agent/{id}', 'destroy');
});
// rekening
Route::controller(RekeningController::class)->group(function () {
    Route::get('rekening', 'index')->name('rekening');
    Route::post('rekening', 'store');
    Route::get('rekening/{id}', 'show');
    Route::post('rekening/{id}', 'update');
    Route::delete('rekening/{id}', 'destroy');
});
// booking
Route::controller(BookingController::class)->group(function () {
    Route::get('booking', 'index')->name('booking');
    Route::get('booking_notin', 'notInPayment')->name('booking_notin');
    Route::post('booking', 'store');
    Route::get('booking/{id}', 'show');
    Route::post('booking/{id}', 'update');
    Route::delete('booking/{id}', 'destroy');
    Route::post('booking_up/{id}', 'updateStatusToLunas')->name('booking_up');
});
// booking detail
Route::controller(BookingDetailController::class)->group(function () {
    Route::get('booking_d', 'index')->name('booking_d');
    Route::post('booking_d', 'store');
    Route::get('booking_d/{id}', 'show');
    Route::get('booking_d_inv/{id}', 'showInv')->name('booking_d_inv');
    Route::post('booking_d/{id}', 'update');
    Route::delete('booking_d/{id}', 'destroy');
});
// payment
Route::controller(PaymentController::class)->group(function () {
    Route::get('payment', 'index')->name('payment');
    Route::post('payment', 'store');
    Route::get('payment/{id}', 'show');
    Route::post('payment/{id}', 'update');
    Route::delete('payment/{id}', 'destroy');
});
// payment detail
Route::controller(PaymentDetailController::class)->group(function () {
    Route::get('payment_d', 'index')->name('payment_d');
    Route::post('payment_d', 'store');
    Route::get('payment_d/{id}', 'show');
    Route::get('payment_d_inv/{id}', 'showInv')->name('payment_d_inv');
    Route::post('payment_d/{id}', 'update');
    Route::delete('payment_d/{id}', 'destroy');
});
// visa
Route::controller(VisaController::class)->group(function () {
    Route::get('visa', 'index')->name('visa');
    Route::post('visa', 'store');
    Route::get('visa/{id}', 'show');
    Route::post('visa/{id}', 'update');
    Route::delete('visa/{id}', 'destroy');
    Route::post('visa_up/{id}', 'updateStatusToLunas')->name('visa_up');
});
// visa detail
Route::controller(VisaDetailController::class)->group(function () {
    Route::get('visa_d', 'index')->name('visa_d');
    Route::post('visa_d', 'store');
    Route::get('visa_d/{id}', 'show');
    Route::get('visa_d_inv/{id}', 'showInv')->name('visa_d_inv');
    Route::post('visa_d/{id}', 'update');
    Route::delete('visa_d/{id}', 'destroy');
});
// kurs visa
Route::controller(KursVisaController::class)->group(function () {
    Route::get('kurs', 'index')->name('kurs');
    Route::post('kurs', 'store');
    Route::get('kurs/{id}', 'show');
});
// privilage
Route::controller(PrivilageController::class)->group(function () {
    Route::get('privilage', 'index')->name('privilage');
    Route::post('privilage', 'store');
    Route::get('privilage/{id}', 'show');
    Route::post('privilage/{id}', 'update');
    Route::delete('privilage/{id}', 'destroy');
});

// role
Route::controller(RoleController::class)->group(function () {
    Route::get('role', 'index')->name('role');
    Route::post('role', 'store');
    Route::get('role/{id}', 'show');
    Route::post('role/{id}', 'update');
    Route::delete('role/{id}', 'destroy');
});
// user
Route::controller(UserController::class)->group(function () {
    Route::get('user', 'index')->name('user');
    Route::post('user', 'store');
    Route::get('user/{id}', 'show');
    Route::post('user/{id}', 'update');
    Route::post('user_reset/{id}', 'resetPassword')->name('user.reset');
    Route::post('user_change/{id}', 'changePassword')->name('user.change');
    Route::delete('user/{id}', 'destroy');
});
