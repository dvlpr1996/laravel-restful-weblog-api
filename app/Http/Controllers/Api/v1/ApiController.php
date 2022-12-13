<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class ApiController extends Controller
{
    private $appUrl;

    public function __construct()
    {
        $this->appUrl = Config::get('app.url');
    }

    public function index()
    {
        $mainEndPoints = [
            'posts' => [
                'all posts' => $this->appUrl . '/api/v1/posts',
                'post by slug' => $this->appUrl . '/api/v1/post/:slug'
            ],
        ];

        return $mainEndPoints;
    }
}
