<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    private function imagePath($image)
    {
        if (! is_null($image)) {
            return public_path().'/storage/'.$image;
        }

        return public_path().'/storage/images/dummy.jpg';
    }

    public function index(Post $post)
    {
        $pdf = PDF::loadView('post', [
            'title' => $post->title,
            'author' => $post->user->fullName(),
            'published_date' => $post->created_at ?? 'not defined',
            'description' => $post->body ?? 'no description',
            'img' => $this->imagePath($post->image?->path),
        ]);

        return $pdf->download('post.pdf');
    }
}
