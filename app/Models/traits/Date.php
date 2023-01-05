<?php

namespace App\Models\traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait Date
{
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
}
