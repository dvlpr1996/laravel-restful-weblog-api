<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\WriterUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        return new UserCollection(User::writer()->paginate(10));
    }

    public function me()
    {
        //
    }

    public function show($requestData)
    {
        if (is_numeric($requestData) && preg_match('/^\d+$/', $requestData)) {
            return new UserResource(User::writer()->findOrFail($requestData));
        }

        if (is_string($requestData) && preg_match('/[-a-zA-Z]+/', $requestData)) {
            return new UserResource(
                User::writer()->where('slug', $requestData)->firstOrFail()
            );
        }
    }

    public function update(WriterUpdateRequest $request, User $user)
    {
        User::where('slug', $user->slug)->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'slug' => Str::slug($request->fname . ' ' . $request->lname),
            'email' => $request->email,
        ]);

        return response()->json([
            'message' => 'your account info successfully updated',
            'status_code' => '200'
        ], 200);
    }

    public function destroy($requestData)
    {
        if (is_numeric($requestData) && preg_match('/^\d+$/', $requestData)) {
            User::writer()->findOrFail($requestData)->delete();
        }

        if (is_string($requestData) && preg_match('/[-a-zA-Z]+/', $requestData)) {
            User::writer()->where('slug', $requestData)->firstOrFail()->delete();
        }

        return response()->json([
            'message' => 'post deleted successfully',
            'status_code' => '200'
        ], 200);
    }
}
