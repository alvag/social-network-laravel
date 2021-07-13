<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/**
 * @property string body
 * @property User user
 * @property Carbon created_at
 * @property mixed id
 */
class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'body'        => $this->body,
            'user_name'   => $this->user->name,
            'user_avatar' => 'https://www.irishrsa.ie/wp-content/uploads/2017/03/default-avatar-300x300.png',
            'ago'         => $this->created_at->diffForHumans(),
            'is_liked'    => $this->isLiked(),
            'likes_count' => $this->likesCount(),
        ];
    }
}
