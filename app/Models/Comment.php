<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Post;
use App\Models\traits\Likeable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory, Likeable;

    protected $fillable = [
        'body',
        'email',
        'author',
        'post_id',
        'reply_of',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    protected function replyOf(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value == '0') ? $value = null : $value
        );
    }
}
