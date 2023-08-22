<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return redirect('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return view('pages.dashboard', ['type_menu' => '']);
    })->name('dashboard')->middleware('can:dashboard');
    Route::get('profile-edit', function () {
        return view('pages.profile', ['type_menu' => '']);
    })->name('profile.edit');

    Route::resource('user', UserController::class);
});
