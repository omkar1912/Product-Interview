<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name'          => $this->name,
            'price'         => $this->price,
            'category'      => new CategoryResource($this->category),
            'created_by'    => new UserResource($this->user)
        ];
    }
}
