<?php

namespace App\Http\Resources\Api\Tweet;

use App\Http\Resources\Api\User\SimpleUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'user'              => SimpleUserResource::make($this->user),
            'body'              => $this->body,
            'created_at'        => $this->created_at?->diffForHumans(),
        ];
    }
}
