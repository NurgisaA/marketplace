<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "categoryId"=> $this->category_id,
            "title"=> $this->title,
            "description"=> $this->description,
            "price"=> $this->price,
            "image"=> $this->image,
        ];
    }
}
