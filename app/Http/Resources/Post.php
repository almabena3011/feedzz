<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
            'id' => $this->id,
            'image' => $this->image,
            'caption' => $this->caption,
            'user' => $this->user,
            'likes_count' => $this->likes_count,
            'like_status' => $this->is_liked() ? 'unlike' : 'like',
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
