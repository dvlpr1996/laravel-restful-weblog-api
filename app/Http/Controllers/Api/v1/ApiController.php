<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class ApiController extends Controller
{
    private $appUrl;
    private $apiVer;

    public function __construct()
    {
        $this->appUrl = Config::get('app.url');
        $this->apiVer = '/api/v1/';
        $this->baseRoute = $this->appUrl . $this->apiVer;
    }

    public function index()
    {
        $mainEndPoints = [
            'posts' => [
                'all posts' => $this->baseRoute . 'posts',
                'post by slug' => $this->baseRoute . 'post/:slug',
                'post store' => $this->baseRoute . 'posts/',
                'post destroy' => $this->baseRoute . 'posts/:id',
                'post update' => $this->baseRoute . 'posts/:slug',
                'user posts' => $this->baseRoute . 'users/{user:slug}/posts'
            ],
            'category' => [
                'category posts' => $this->baseRoute . 'categories/{category:slug}/posts'
            ],
            'tag' => [
                'tag posts' => $this->baseRoute . 'tags/{tagged:slug}/posts'
            ],
            'user' => [
                'get all writers' => $this->baseRoute . 'users',
                'get writer by id' => $this->baseRoute . 'users/{user:id}',
                'get writer by slug' => $this->baseRoute . 'users/{user:slug}',
                'get auth writer' => $this->baseRoute . 'auth/me',
                'update writer info' => $this->baseRoute . 'users/{user:slug}',
                'delete writer info' => $this->baseRoute . 'users/{user:id}',
            ],
            'auth' => [
                'login' => $this->baseRoute . 'auth/login',
                'logout' => $this->baseRoute . 'auth/logout',
            ]
        ];

        return $mainEndPoints;
    }
}
