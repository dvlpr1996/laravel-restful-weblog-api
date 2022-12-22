<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'bio',
        'slug',
        'email',
        'role',
        'fname',
        'lname',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function fullName()
    {
        return str_replace('-', ' ', $this->attributes['slug']);
    }

    public function gravatar()
	{
		$hash = md5(strtolower($this->attributes['email']));
		return "http://s.gravatar.com/avatar/$hash";
	}

    public function scopeWriter($query)
    {
        $query->where('role', '0');
    }

    public function scopeAdmin($query)
    {
        $query->where('role', '1');
    }

    public function scopeSort(Builder $query, array $params)
    {
        if (isset($params['q']))
            $query->posts()->where('slug', 'like', '%' . $params['q'] . '%');

        return $query;
    }
}
