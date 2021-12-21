<?php

use App\Http\Controllers\Api\{PlaylistController, VideoController};
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\CheckUserPlaylistController;
use App\Http\Controllers\MyPlaylistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Screencast\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('playlists')->group(function () {
    Route::get('', [PlaylistController::class, 'index']);
    Route::get('{playlist:slug}', [PlaylistController::class, 'show']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('{playlist:slug}/videos', [VideoController::class, 'index']);
        Route::get('{playlist:slug}/{video:episode}', [VideoController::class, 'show']);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', ProfileController::class);
    Route::post('/playlist/buy/{playlist:slug}', [PlaylistController::class, 'buyPlaylist']);
    Route::get('carts', [CartController::class, 'index']);
    Route::post('add-to-cart/{playlist:slug}', [CartController::class, 'store']);
    Route::post('carts/checkout', [OrderController::class, 'store']);
    Route::delete('/carts/{cart}/delete', [CartController::class, 'destroy']);

    Route::get('/my-playlists', [MyPlaylistController::class, 'index']);
    Route::get('/check-playlist-{playlist:slug}', [CheckUserPlaylistController::class, 'index']);
});

Route::post('/payments/complete', [OrderController::class, 'orderSuccessHandle']);
