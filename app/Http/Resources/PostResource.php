<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PostResource
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'content'    => $this->content,
            'status'     => $this->status,
            'categories' => CategoryResource::collection($this->categories),
            'likes'      => $this->likesTotal(),
            'author'     => $this->user_id,
            'created_at' => $this->created_at
        ];
    }
}
