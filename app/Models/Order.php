<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['playlists_id', 'order_identifier', 'total_price'];

    protected $casts = [
        'playlists_id' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
