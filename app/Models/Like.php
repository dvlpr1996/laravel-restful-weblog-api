<?php

namespace App\Models;

use App\Models\traits\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory, Date;

    protected $fillable = [
        'vote',
        'user_id'
    ];

    public function likeable()
    {
        return $this->morphTo();
    }
}
