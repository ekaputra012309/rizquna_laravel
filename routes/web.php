<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

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
    return view('page/login');
});

Route::prefix('pages')->name('p.')->group(function () {
    Route::get('signin', [PagesController::class, 'signin'])->name('signin');
    Route::get('dash', [PagesController::class, 'dash'])->name('dash');
    Route::get('hotel', [PagesController::class, 'hotel'])->name('hotel');
    Route::get('hotel/tambah', [PagesController::class, 'tambahHotel'])->name('hotel.tambah');
    Route::get('hotel/edit/{id}', [PagesController::class, 'editHotel'])->name('hotel.edit');
    Route::get('room', [PagesController::class, 'room'])->name('room');
    Route::get('room/tambah', [PagesController::class, 'tambahRoom'])->name('room.tambah');
    Route::get('room/edit/{id}', [PagesController::class, 'editRoom'])->name('room.edit');
    Route::get('agent', [PagesController::class, 'agent'])->name('agent');
    Route::get('agent/tambah', [PagesController::class, 'tambahAgent'])->name('agent.tambah');
    Route::get('agent/edit/{id}', [PagesController::class, 'editAgent'])->name('agent.edit');
    Route::get('rekening', [PagesController::class, 'rekening'])->name('rekening');
    Route::get('rekening/tambah', [PagesController::class, 'tambahRekening'])->name('rekening.tambah');
    Route::get('rekening/edit/{id}', [PagesController::class, 'editRekening'])->name('rekening.edit');
    Route::get('booking', [PagesController::class, 'booking'])->name('booking');
    Route::get('booking/tambah', [PagesController::class, 'tambahBooking'])->name('booking.tambah');
    Route::get('booking/edit/{id}', [PagesController::class, 'editBooking'])->name('booking.edit');
    Route::get('payment', [PagesController::class, 'payment'])->name('payment');
    Route::get('payment/lihat/{id}', [PagesController::class, 'lihatPayment'])->name('payment.lihat');
    Route::get('payment/cetak/{id}', [PagesController::class, 'cetakPayment'])->name('payment.cetak');
    Route::get('reportagent', [PagesController::class, 'reportAgent'])->name('report.agent');
    Route::get('visa', [PagesController::class, 'visa'])->name('visa');
    Route::get('visa/tambah', [PagesController::class, 'tambahVisa'])->name('visa.tambah');
    Route::get('visa/edit/{id}', [PagesController::class, 'editVisa'])->name('visa.edit');
    Route::get('visa/lihat/{id}', [PagesController::class, 'lihatVisa'])->name('visa.lihat');
    Route::get('visa/cetak/{id}', [PagesController::class, 'cetakVisa'])->name('visa.cetak');
    Route::get('role', [PagesController::class, 'role'])->name('role');
    Route::get('role/tambah', [PagesController::class, 'tambahRole'])->name('role.tambah');
    Route::get('role/edit/{id}', [PagesController::class, 'editRole'])->name('role.edit');
    Route::get('user', [PagesController::class, 'user'])->name('user.management');
    Route::get('user/tambah', [PagesController::class, 'tambahUser'])->name('user.tambah');
    Route::get('user/edit/{id}', [PagesController::class, 'editUser'])->name('user.edit');
    Route::get('privilage', [PagesController::class, 'privilage'])->name('privilage');
    Route::get('privilage/tambah', [PagesController::class, 'tambahPrivilage'])->name('privilage.tambah');
    Route::get('privilage/edit/{id}', [PagesController::class, 'editPrivilage'])->name('privilage.edit');

    // 09 April 2025
    Route::get('cabang', [PagesController::class, 'cabang'])->name('cabang');
    Route::get('cabang/tambah', [PagesController::class, 'tambahCabang'])->name('cabang.tambah');
    Route::get('cabang/edit/{id}', [PagesController::class, 'editCabang'])->name('cabang.edit');
    Route::get('bcabang', [PagesController::class, 'bcabang'])->name('bcabang');
    Route::get('jamaah', [PagesController::class, 'jamaah'])->name('jamaah');
    Route::get('jamaah/tambah', [PagesController::class, 'tambahJamaah'])->name('jamaah.tambah');
    Route::get('jamaah/edit/{id}', [PagesController::class, 'editJamaah'])->name('jamaah.edit');
    // 14 april 2025
    Route::get('kwitansi/cetak/{id}', [PagesController::class, 'cetakkwitansi'])->name('kwitansi.cetak');
});

Route::get('/check-session', function () {
    return response()->json([
        'sessionExpired' => auth()->guest(), // Check if the user is a guest (not logged in)
    ]);
});
