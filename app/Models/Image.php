<?php

namespace App\Models;

use App\Models\Post;
use App\Models\traits\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory, Date;

    protected $fillable = [
        'path',
        'post_id',
    ];

    protected $hidden = [
        'id',
        'post_id',
        'created_at',
        'updated_at'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
