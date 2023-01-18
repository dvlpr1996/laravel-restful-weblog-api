<?php

namespace App\Services;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    private $storagePath = 'app/public/images/';

    private function setImageFileName($request)
    {
        return Str::slug($request->title) . '.' . $request->file('image')->extension();
    }

    private function checkDirectory()
    {
        if (!Storage::disk('public')->exists('/images/'))
            Storage::disk('public')->makeDirectory('images');
    }

    private function pathSetter()
    {
        return storage_path($this->storagePath);
    }

    public function uploadImageFile($request)
    {
        $this->checkDirectory();

        $image = Image::make($request->file('image'));
        $filePath = $this->setImageFileName($request);
        $image->save($this->pathSetter() . $filePath);

        return 'images/' . $filePath;
    }
}
