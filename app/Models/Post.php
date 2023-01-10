<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Category;
use App\Models\traits\Date;
use Conner\Tagging\Taggable;
use App\Models\traits\Likeable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Taggable, Likeable, Date;

    protected $fillable = [
        'body',
        'slug',
        'title',
        'user_id',
        'summary',
        'tags',
        'category_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function scopeSort(Builder $query, array $params)
    {
        if (isset($params['q']))
            $query->where('slug', 'like', '%' . $params['q'] . '%');

        if (isset($params['sort']) && $params['sort'] == 'oldest')
            $query->orderBy('created_at', 'asc');

        if (isset($params['sort']) && $params['sort'] == 'latest')
            $query->orderByDesc('created_at');

        return $query;
    }
}
