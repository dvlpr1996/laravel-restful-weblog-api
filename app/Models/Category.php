<?php

namespace App\Models;

use App\Models\traits\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Date;

    protected $fillable = [
        'slug',
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
