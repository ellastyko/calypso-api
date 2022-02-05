<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterAction
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function handle(array $data): JsonResponse
    {
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        event(new Registered($user));

        return response()->json([
            'message' => trans('auth.registered'),
            'user' => $user
        ]);
    }
}
