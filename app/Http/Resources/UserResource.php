<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->fullName(),
            'bio' => $this->bio,
            'email' => $this->email,
            'profile' => $this->gravatar(),
            'posts' => PostResource::collection($this->posts),
        ];
    }
}
