<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\UploadService;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    private $uploadFile;

    public function __construct()
    {
        $this->resourceHandlerTraitNameSpaceSetter('post');
        $this->uploadFile = new UploadService;
    }

    public function index(Request $request)
    {
        return $this->showApiDataCollectionWithPagination(false);
    }

    public function store(PostRequest $request)
    {
        $this->authorize('create', Post::class);

        $post = Post::create([
            'body' => $request->body,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'summary' => $request->summary,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'tags' => $request->tags,
        ]);

        $post->tag(explode(", ", $request->tags));

        $file = $this->uploadFile->uploadImageFile($request);

        Image::create([
            'post_id' => $post->id,
            'path' => $file
        ]);

        return response()->json([
            'message' => __('api.post_create_ok'),
            'status_code' => '201'
        ], 201);
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update([
            'body' => $request->body,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'summary' => $request->summary,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'tags' => $request->tags,
        ]);

        $post->tag(explode(", ", $request->tags));

        $file = $this->uploadFile->uploadImageFile($request);

        $image = Image::where('post_id', $post->id)->firstOrFail();
        $image->path = $file;
        $image->post_id = $post->id;
        $image->save();

        return response()->json([
            'message' => __('api.post_update_ok'),
            'status_code' => '200'
        ], 200);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post = Post::where('id', $post->id)->firstOrFail();
        Storage::delete($post->image->path);
        $post->delete();

        return response()->json([
            'message' => __('api.post_del_ok'),
            'status_code' => '200'
        ], 200);
    }

    public function show($requestData)
    {
        return $this->showApiData($requestData);
    }

    public function userPost(Request $request, User $user)
    {
        return $this->showApiDataCollection($user->posts()->sort($request->all())->paginate(10));
    }
}
