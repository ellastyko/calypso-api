<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserAvatarRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use LaravelLang\Publisher\Console\Update;


class UserController extends Controller
{
    /**
     * @param UserAvatarRequest $request
     * @param UserService $service
     * @return false|string
     */
    public function avatar(UserAvatarRequest $request, UserService $service): bool|string
    {
        return $service->avatar($request->file('avatar'));
    }


    /**
     * @return Collection|User[]
     */
    public function index(IndexRequest $request, UserService $service)
    {
        return $service->index($request->validated());
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $user = User::create([
            'login' => $request['login'],
            'name' => $request['name'],
            'password' => Hash::make($request['password']),
            'email' => $request['email'],
            'role' => $request['role']
        ]);
        return response([
            'message' => trans('auth.registered'),
            'user' => $user
        ]);
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * @param UpdateUserRequest $request
     * @param UserService $service
     * @param int $id
     * @return Response
     */
    public function update(UpdateUserRequest $request, UserService $service, int $id)
    {
        return $service->update($request->validated());
    }

    /**
     * @param  int  $id
     * @return Response
     * ONLY ADMINS
     */
    public function destroy(int $id)
    {

        User::findOrFail()->destroy();

        return response([
            'message' => 'User deleted successfully'
        ]);
    }
}
