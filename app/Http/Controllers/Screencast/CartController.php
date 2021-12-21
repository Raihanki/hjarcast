<?php

namespace App\Http\Controllers\Screencast;

use App\Models\{Playlist, Cart};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return CartResource::collection(Auth::user()->carts()->with('user', 'playlist')->get());
    }

    public function store(Playlist $playlist)
    {
        $cartExist = Auth::user()->carts()->where('playlist_id', $playlist->id)->first();
        if (!$cartExist) {
            $cartCreated = Auth::user()->carts()->create([
                "playlist_id" => $playlist->id,
                "price" => $playlist->price
            ])->load('playlist');
            return response()->json([
                "success" => true,
                "message" => "Successfully added playlist to cart",
                "data" => $cartCreated
            ]);
        }
        return response()->json([
            "success" => false,
            "message" => "You alredy have this playlist in your cart",
            "data" => []
        ]);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return response()->json([
            "message" => "Cart successfully removed"
        ]);
    }
}
