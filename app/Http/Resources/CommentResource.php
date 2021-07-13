<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'body'        => $this->body,
            'user_name'   => $this->user->name,
            'user_avatar' => 'https://www.irishrsa.ie/wp-content/uploads/2017/03/default-avatar-300x300.png',
        ];
    }
}
