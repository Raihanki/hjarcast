<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'description', 'unique_video_id', 'episode', 'runtime', 'is_intro'];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}
