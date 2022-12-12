<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post_tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'tag_id'
    ];

    protected $table = 'post_tag';
}
