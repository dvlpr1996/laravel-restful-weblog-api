<?php

namespace App\Models;

use App\Models\traits\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostTag extends Model
{
    use HasFactory, Date;

    protected $fillable = [
        'post_id',
        'tag_id'
    ];

    protected $table = 'post_tag';
}
