<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'email',
        'author',
        'post_id',
        'reply_of',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function like()
    {
        return $this->morphOne(Like::class, 'likeable');
    }
}
