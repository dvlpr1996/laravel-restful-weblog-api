<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function me()
    {
        //
    }

    public function store(Request $request)
    {

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

    public function update(Request $request, $slug)
    {
        
    }

    public function destroy($requestData)
    {
        if (is_numeric($requestData) && preg_match('/^\d+$/', $requestData)) {
            User::findOrFail($requestData)->delete();
        }

        if (is_string($requestData) && preg_match('/[-a-zA-Z]+/', $requestData)) {
            User::where('slug', $requestData)->firstOrFail()->delete();
        }

        return response()->json([
            'message' => 'post deleted successfully',
            'status_code' => '200'
        ], 200);
    }
}
