<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Requests\WriterUpdateRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        return new UserCollection(User::writer()->paginate(10));
    }

    public function me()
    {
        return new UserResource(auth()->user());
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
            'message' => __('api.account_update_ok'),
            'status_code' => '200'
        ], 200);
    }

    public function destroy(User $user)
    {
        User::writer()->findOrFail($user->id)->delete();
        return response()->json([
            'message' => __('api.account_delete_ok'),
            'status_code' => '200'
        ], 200);
    }
}
