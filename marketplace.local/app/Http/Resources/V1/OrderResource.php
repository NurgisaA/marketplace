<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->resource->with(['size', 'color']);
        return [
            "id" => $this->id,
            "amount" => $this->amount,
            "state" => $this->state,
            "address" => $this->address,
            "phone" => $this->phone,
            "user" => new UserResource($this->user),
            "products" => new ProductsCollection($this->product),
        ];
    }
}


