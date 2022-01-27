<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserAvatarRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


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
    public function index()
    {
        return User::all();
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
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Переписать функцию чтобы юзеров могли редактировать и владелец и админ
         */
    }

    /**
     * @param  int  $id
     * @return Response
     * ONLY ADMINS
     */
    public function destroy($id)
    {

        User::findOrFail()->destroy();

        return response([
            'message' => 'User deleted successfully'
        ]);
    }
}
