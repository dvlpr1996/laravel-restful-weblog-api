<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    private function setImageFileName($request)
    {
        return Str::slug($request->title) . '.' . $request->file('image')->extension();
    }

    private function checkDirectory()
    {
        if (!Storage::disk('public')->exists('/images/'))
            Storage::disk('public')->makeDirectory('images');
    }

    public function uploadImageFile($request)
    {
        $this->checkDirectory();

        $file = Storage::putFileAs(
            'public/images',
            $request->file('image'),
            $this->setImageFileName($request)
        );

        if (!$file) return __('api.file_error');

        return $file;
    }
}
