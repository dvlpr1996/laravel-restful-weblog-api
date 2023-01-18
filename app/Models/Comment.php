<?php

namespace App\Models;

use App\Models\traits\Date;
use App\Models\traits\Likeable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, Likeable, Date;

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
