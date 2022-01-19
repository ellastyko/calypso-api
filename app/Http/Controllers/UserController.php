<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function avatar(Request $request)
    {
        $request->avatar->storeAs('/avatars', ['disk' => 'public']);
        /*
         *  *** Store file with random name ***
         * Storage::put('app/avatars', $request->avatar);
         * Storage::disk('public')->put('avatars', $request->avatar);
         */

        /*
         * Store image by specific name
         *  ** disk - namespace folder in storage
         */
        $avatar = $request->file('avatar');
        $path = Storage::disk('public')->putFileAs(
            'avatars', $avatar, 'orig-name-for-photo.'.$avatar->extension()
        );
        return $path;
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
