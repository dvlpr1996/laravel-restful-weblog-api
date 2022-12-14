<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
