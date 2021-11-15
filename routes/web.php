<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Screencast\{PlaylistController, TagController};
use App\Models\Playlist;
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

Route::get('/dashboard', DashboardController::class)->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->middleware('permission:manage users')->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Playlist Routes
    Route::prefix('playlists')->middleware('permission: create playlists')->group(function () {
        Route::get('', [PlaylistController::class, 'index'])->name('playlists.index');
        Route::get('create', [PlaylistController::class, 'create'])->name('playlists.create');
    });

    // Tag Routes
    Route::prefix('tags')->middleware('permission: create tags')->group(function () {
        Route::get('', [TagController::class, 'index'])->name('tags.index');
        Route::get('create', [TagController::class, 'create'])->name('tags.create');
    });
});
