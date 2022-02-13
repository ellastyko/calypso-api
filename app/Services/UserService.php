<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserFavorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function index(array $data = []): mixed
    {
        return User::paginate($data['per_page']);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'] ?? '',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role']
        ]);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        return User::find($id)->fill($data);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function destroy(User $user): bool
    {
        return $user->delete();
    }

    /**
     * @param $avatar
     * @return false|string
     */
    public function avatar($avatar)
    {
        /*
         *  *** Store file with random name ***
         * Storage::put('app/avatars', $request->avatar);
         * Storage::disk('public')->put('avatars', $request->avatar);
         */

        /*
         * Store image by specific name
         *  ** disk - namespace folder in storage
         */
        $path = Storage::disk('public')->putFileAs(
            'avatars', $avatar, Auth::id().'.'.$avatar->extension()
        );
        return $path;
    }

    public function favorites()
    {
        return UserFavorite::where('user_id', '=', Auth::id())->get();
    }
}
