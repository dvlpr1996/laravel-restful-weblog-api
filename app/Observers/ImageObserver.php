<?php

namespace App\Observers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageObserver
{
    public function updated(Image $image)
    {
        Storage::delete($image->getOriginal('path'));
    }
}
