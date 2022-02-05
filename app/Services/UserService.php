<?php

namespace App\Services;

use App\Models\User;
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
        return User::all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
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
        // Add policy TODO
        return User::find($id)->fill($data);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function destroy(User $user): bool
    {
        // Add policy TODO
        return $user->delete();
    }

    /**
     * @param $avatar
     * @param $user
     * @return false|string
     */
    public function avatar($avatar, $user)
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
            'avatars', $avatar, $user->id.'.'.$avatar->extension()
        );
        return $path;
    }
}
