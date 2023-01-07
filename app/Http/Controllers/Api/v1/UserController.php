<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\WriterUpdateRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->resourceHandlerTraitNameSpaceSetter('user');
    }

    public function index()
    {
        return $this->showApiDataCollection(User::writer()->paginate(10));
    }

    public function me()
    {
        return $this->showApiDataResource(auth()->user());
    }

    public function show($requestData)
    {
        return $this->showApiData($requestData);
    }

    public function update(WriterUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

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
        $this->authorize('delete', $user);

        $this->getDataBySlug($user->slug)->delete();

        return response()->json([
            'message' => __('api.account_delete_ok'),
            'status_code' => '200'
        ], 200);
    }
}
