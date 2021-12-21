<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Playlist;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function store()
    {
        $data = Auth::user()->orders()->create([
            "playlists_id" => Auth::user()->carts()->pluck('playlist_id'),
            "order_identifier" => "order-" . time() . "-num-" . Str::random(6),
            "total_price" => Auth::user()->carts()->sum('price')
        ]);

        $params = [
            "enabled_payments" => [
                "credit_card", "bca_va", "bni_va", "bri_va", "other_va", "gopay", "akulaku", "shopeepay"
            ],
            "transaction_details" => [
                "order_id" => $data->order_identifier,
                "gross_amount" => $data->total_price
            ],
            "custommer_details" => Auth::user(),
            "expiry" => [
                "start_time" => now()->format("Y-m-d H:i:s T"),
                "unit" => "days",
                "duration" => 1
            ]
        ];

        $headers = [
            'Authorization' => 'Basic ' . base64_encode(config('payment.server_key')),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $url = "https://app.sandbox.midtrans.com/snap/v1/transactions";
        $response = Http::withHeaders($headers)->post($url, $params);

        return $response;
    }

    public function orderSuccessHandle(Request $request)
    {
        $signature = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . config('payment.server_key'));
        if ($signature !== $request->signature_key) {
            abort(404);
        }

        $order = Order::where('order_identifier', $request->order_id)->first();
        $user = User::findOrFail($order->user_id);

        Log::info($order);
        foreach ($order->playlists_id as $item) {
            $playlist = Playlist::find($item);
            $user->buyPlaylist($playlist);
        }
        $order->delete();
        $user->carts()->delete();

        return response()->json([
            "message" => "Playlist successfully purchased"
        ]);
    }
}
