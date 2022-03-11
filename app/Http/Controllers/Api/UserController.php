<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\User\UserAvatarRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\FavoritesResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use function response;

/**
 * @class UserController
 */
class UserController extends Controller
{
    /**
     * @param UserAvatarRequest $request
     * @param UserService $service
     * @return false|string
     */
    public function avatar(UserAvatarRequest $request, UserService $service)
    {
        return $service->avatar($request->file('avatar'));
    }

    /**
     * @param UserService $service
     * @return FavoritesResource
     */
    public function favorites(UserService $service): FavoritesResource
    {
        return new FavoritesResource($service->favorites());
    }


    /**
     * @return Collection|User[]
     */
    public function index(IndexRequest $request, UserService $service)
    {
        return $service->index($request->validated());
    }

    /**
     * @param UserStoreRequest $request
     * @param UserService $service
     * @return Response
     */
    public function store(UserStoreRequest $request, UserService $service): Response
    {
        return response([
            'message' => trans('auth.registered'),
            'user' => $service->store($request->validated())
        ]);
    }

    /**
     * @param int $id
     * @return UserResource
     */
    public function show($id): UserResource
    {
        return new UserResource(User::findOrFail($id));
    }

    /**
     * @param UserUpdateRequest $request
     * @param UserService $service
     * @param int $id
     * @return bool
     */
    public function update(UserUpdateRequest $request, UserService $service, int $id)
    {
        return $service->update($request->validated(), $id);
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id)
    {

        User::findOrFail($id)->delete();

        return response([
            'message' => 'User deleted successfully'
        ]);
    }
}
