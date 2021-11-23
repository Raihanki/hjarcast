<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Screencast\{PlaylistController, TagController, VideoController};
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
    Route::prefix('playlists')->middleware(['permission:create playlists'])->group(function () {
        Route::get('', [PlaylistController::class, 'index'])->name('playlists.index');
        Route::get('create', [PlaylistController::class, 'create'])->name('playlists.create');
        Route::post('store', [PlaylistController::class, 'store'])->name('playlists.store');
        Route::get('{playlist:slug}/edit', [PlaylistController::class, 'edit'])->name('playlists.edit');
        Route::put('{playlist:slug}/update', [PlaylistController::class, 'update'])->name('playlists.update');
        Route::delete('{playlist:slug}/destroy', [PlaylistController::class, 'destroy'])->name('playlists.destroy');
    });

    // Tag Routes
    Route::prefix('tags')->middleware(['can:create tags'])->group(function () {
        Route::get('', [TagController::class, 'index'])->name('tags.index');
        Route::get('create', [TagController::class, 'create'])->name('tags.create');
        Route::post('store', [TagController::class, 'store'])->name('tags.store');

        Route::middleware(['can:update tags|create tags'])->group(function () {
            Route::get('{tag:slug}/edit', [TagController::class, 'edit'])->name('tags.edit');
            Route::put('{tag:slug}/update', [TagController::class, 'update'])->name('tags.update');
            Route::delete('{tag:slug}/destroy', [TagController::class, 'destroy'])->name('tags.destroy');
        });
    });

    //Videos Route
    Route::prefix('videos')->middleware(['permission:create playlists'])->group(function () {
        Route::get('{playlist:slug}/videos', [VideoController::class, 'index'])->name('videos.index');
        Route::get('{playlist:slug}/create', [VideoController::class, 'create'])->name('videos.create');
        Route::post('{playlist:slug}/store', [VideoController::class, 'store'])->name('videos.store');
        Route::get('{playlist:slug}/{video:unique_video_id}/edit', [VideoController::class, 'edit'])->name('videos.edit');
        Route::put('{playlist:slug}/{video:unique_video_id}/update', [VideoController::class, 'update'])->name('videos.update');
        Route::delete('{playlist:slug}/{video:unique_video_id}/destroy', [VideoController::class, 'destroy'])->name('videos.destroy');
    });
});
