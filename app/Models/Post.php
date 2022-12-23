<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Category;
use Conner\Tagging\Taggable;
use App\Models\traits\Likeable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Taggable, Likeable;

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

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('Y-m-d', strtotime($value))
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('Y-m-d', strtotime($value))
        );
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
