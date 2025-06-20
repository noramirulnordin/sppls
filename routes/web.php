<?php

use App\Http\Controllers\BalakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KawasanController;
use App\Http\Controllers\LoriController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\ResitController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::get('profile', [HomeController::class, 'profile'])
        ->name('profile');
    Route::put('profile', [HomeController::class, 'updateProfile'])
        ->name('profile.update');
    Route::put('change-password', [HomeController::class, 'changePassword'])
        ->name('profile.change-password');

    Route::resource('users', UserController::class)
        ->names('users')
        ->middleware(CheckRole::class);
    Route::get('users/{user}/reset-password', [UserController::class, 'resetPassword'])
        ->name('users.reset_password')
        ->middleware(CheckRole::class);

    Route::resource('balaks', BalakController::class)
        ->names('balaks');

    Route::resource('pembelis', PembeliController::class)
        ->names('pembelis');

    Route::get('pembeli-select2', [PembeliController::class, 'select2'])
        ->name('pembelis.select2');

    Route::resource('transaksis', TransaksiController::class)
        ->names('transaksis');

    Route::resource('resits', ResitController::class)
        ->names('resits');
    Route::get('resit-download/{resit}', [ResitController::class, 'download'])
        ->name('resits.download');

    Route::resource('loris', LoriController::class)
        ->names('loris');

    Route::resource('kawasans', KawasanController::class)
        ->names('kawasans');

    Route::get('kawasans/{kawasan}/loris', [KawasanController::class, 'loris'])
        ->name('kawasans.loris');

});
