<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;

class PostController extends Controller
{
    public function index()
    {
        return new PostCollection(Post::paginate(10));
    }

    public function store(Request $request)
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($requestData)
    {
        if (is_numeric($requestData) && preg_match('/^\d+$/', $requestData)) {
            return Post::findOrFail($requestData)->delete();
        }

        if (is_string($requestData) && preg_match('/[-a-zA-Z]+/', $requestData)) {
            return Post::where('slug', $requestData)->firstOrFail()->delete();
        }
    }
}
