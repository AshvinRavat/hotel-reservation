<?php

use App\Http\Controllers\Customer\HotelController as CustomerHotelController;
use App\Http\Controllers\Customer\RoomController as CustomerRoomController;
use App\Http\Controllers\Customer\RoomReservationController;
use App\Http\Controllers\Owner\BecomeOwnerController;
use App\Http\Controllers\Owner\HotelController;
use App\Http\Controllers\Owner\RoomController;
use App\Http\Controllers\Owner\RoomReservationController as OwnerRoomReservationController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [CustomerHotelController::class, 'index'])->name('index');
Route::get('hotel/{hotel}/rooms', [CustomerRoomController::class, 'index'])->name('customer.hotel_rooms');
Route::get('hotel/room/{room}', [CustomerRoomController::class, 'viewRoomDetails'])->name('customer.hotel_room_detail');


Route::post('/get-booking-details', [RoomReservationController::class, 'getBookingDetailsAndCreatingBill'])->name('customer.reservation');
Route::get('/confirm-booking', [RoomReservationController::class, 'confirmBookingAndReservation'])
->name('customer.confirm_reservation');

Route::get('/customer/reservation/success', [RoomReservationController::class, 'reservationSuccess'])->name('customer.reservation_success');


Route::middleware(['auth', 'verified'])->name('customer.')->group(function () {
    Route::prefix('reservations')
    ->name('reservations_')->controller(RoomReservationController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/reservation-details/{reservation}', 'reservationDetail')->name('detail');
    });
});

Route::middleware(['auth', 'verified'])->controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::post('/profile-update', 'update')->name('profile.update');
    Route::get('/password-update', 'updatePasswordView')->name('password.update_index');
    Route::post('/password-update', 'updatePassword')->name('password.update');
    Route::get('/delete-account', 'deleteAccountIndex')->name('profile.delete_index');
    Route::post('/delete-account', 'destroy')->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('become-owner', [BecomeOwnerController::class, 'index'])->name('become_owner_index');
    Route::post('become-owner', [BecomeOwnerController::class, 'updatingUserAsOwner'])->name('become_owner');
    Route::get('become-owner/successful', [BecomeOwnerController::class, 'becomingOwnerSuccessfully'])->name('become_owner_successfully');
});

Route::prefix('owner')->middleware(['auth', 'verified'])->name('owner.')->group(function () {

    Route::prefix('hotel/')->name('hotel_')->controller(HotelController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{hotel}', 'edit')->name('edit');
        Route::post('update/{hotel}', 'update')->name('update');
        Route::post('delete/{hotel}', 'delete')->name('delete');
    });

    Route::prefix('room/')->name('room_')->controller(RoomController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{room}', 'edit')->name('edit');
        Route::post('update/{room}', 'update')->name('update');
        Route::post('delete/{room}', 'delete')->name('delete');
    });

    Route::prefix('/reservations')->name('reservations_')
    ->controller(OwnerRoomReservationController::class)
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('order-detail/{reservation}', 'orderDetail')->name('order_detail');
        Route::post('/update-reservation-status', 'updateReservationStatus')->name('update_reservation_status');
    });
});

require __DIR__.'/auth.php';
