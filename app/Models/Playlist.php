<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    protected $fillable = ['thumbnail', 'name', 'slug', 'description', 'price'];
    protected $withCount = ['videos'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function purchased_by()
    {
        return $this->belongsToMany(User::class, 'purchases_playlists', 'playlist_id', 'user_id');
    }

    public function hasBuy(Playlist $playlist)
    {
        return $this->purchased_playlists()->find($playlist);
    }
}
