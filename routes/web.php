<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Owner\BecomeOwnerController;
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

Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth', 'verified'])->controller(ProfileController::class)->group(function () {
    Route::get('/profile',  'edit')->name('profile.edit');
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



require __DIR__.'/auth.php';
