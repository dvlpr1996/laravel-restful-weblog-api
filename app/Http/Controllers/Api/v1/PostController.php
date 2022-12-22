<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return new PostCollection(Post::sort($request->all())->paginate(10)->withQueryString());
    }

    public function store(PostRequest $request)
    {
        $fileName = Str::slug(mt_rand(1, time()) . ' ' . $request->title) . '.' . $request->file('image')->extension();

        if (!Storage::disk('public')->exists('/images/')) {
            Storage::disk('public')->makeDirectory('images');
        }

        $tags = explode(", ", $request->tags);

        $post = Post::create([
            'body' => $request->body,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'summary' => $request->summary,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'tags' => $request->tags,
        ]);

        $post->tag($tags);

        $file = Storage::putFileAs('public/images', $request->file('image'), $fileName);

        if (!$file) {
            $file = __('api.file_error');
        }

        Image::create([
            'post_id' => $post->id,
            'path' => $file
        ]);

        return response()->json([
            'message' => __('api.post_create_ok'),
            'status_code' => '201'
        ], 201);
    }

    public function show($requestData)
    {
        if (is_numeric($requestData) && preg_match('/^\d+$/', $requestData)) {
            return new PostResource(Post::findOrFail($requestData));
        }

        if (is_string($requestData) && preg_match('/[-a-zA-Z]+/', $requestData)) {
            return new PostResource(Post::where('slug', $requestData)->firstOrFail());
        }
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $fileName = Str::slug($request->title) . '.' . $request->file('image')->extension();

        if (!Storage::disk('public')->exists('/images/')) {
            Storage::disk('public')->makeDirectory('images');
        }

        $tags = explode(", ", $request->tags);

        $post->update([
            'body' => $request->body,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'summary' => $request->summary,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'tags' => $request->tags,
        ]);

        $post->tag($tags);

        $file = Storage::putFileAs('public/images', $request->file('image'), $fileName);

        if (!$file) {
            $file = __('api.file_error');
        }

        $image = Image::where('post_id', $post->id)->update([
            'post_id' => $post->id,
            'path' => $file
        ]);

        return response()->json([
            'message' => __('api.post_update_ok'),
            'status_code' => '200'
        ], 200);
    }

    public function destroy($requestData)
    {
        if (is_numeric($requestData) && preg_match('/^\d+$/', $requestData)) {
            Post::findOrFail($requestData)->delete();
        }

        if (is_string($requestData) && preg_match('/[-a-zA-Z]+/', $requestData)) {
            Post::where('slug', $requestData)->firstOrFail()->delete();
        }

        return response()->json([
            'message' => __('api.post_del_ok'),
            'status_code' => '200'
        ], 200);
    }

    public function userPost(Request $request, User $user)
    {
        return new PostCollection($user->posts()->sort($request->all())->paginate(10));
    }
}
