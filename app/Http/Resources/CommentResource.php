<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'post_id' => $this->post_id,
            'author' => $this->author,
            'email' => $this->email,
            'body' => $this->body,
            'replies_for' => $this->reply_of,
        ];
    }
}
