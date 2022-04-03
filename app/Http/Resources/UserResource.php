<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 */
class UserResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'surname'  => $this->surname,
            'fullname' => $this->getFullName(),
            'email'    => $this->email,
            'role'     => $this->role,
            'status'       => $this->status,
            'major_avatar' => $this->majorAvatar,
            'avatars'      => $this->userAvatar
        ];
    }
}
