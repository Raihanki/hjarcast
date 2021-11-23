<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaylistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "thumbnail" => asset('storage') . '/' . $this->thumbnail,
            "name" => $this->name,
            "slug" => $this->slug,
            "description" => $this->description,
            "price" => [
                "formated" => number_format($this->price, 0, '.', '.'),
                "unformated" => $this->price
            ],
            "videos" => $this->videos_count,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "user" => $this->user
        ];
    }
}
