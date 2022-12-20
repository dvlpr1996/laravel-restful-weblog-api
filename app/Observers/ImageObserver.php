<?php

namespace App\Observers;

use App\Models\Image;

class ImageObserver
{
    public function updated(Image $image)
    {
        dd($image);
        // $image->getOriginal();
    }

    public function deleted(Image $image)
    {
        //
    }
}
