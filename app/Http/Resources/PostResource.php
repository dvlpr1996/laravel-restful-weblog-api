<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'category' => $this->category,
            'image' => $this->images,
            'tags' => $this->tags,
            'comment_count' => count($this->comments) ?? '0',
            'like_count' => $this->likesCount ?? '0',
            'disLike_count' => $this->dislikesCount ?? '0',
            'author' => $this->user->only('slug', 'fname', 'lname'),
            'published_date' => $this->created_at,
            'update_date' => $this->updated_at,
            'body' => $this->body,
        ];
    }
}
