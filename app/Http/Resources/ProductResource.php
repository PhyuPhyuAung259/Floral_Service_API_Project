<?php

namespace App\Http\Resources;

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
            'id'=>$this->id,
            'name'=>$this->name,
            'product_detail'=>$this->product_detail,
            'price'=>$this->price,
            'stock'=>$this->stock,
            'event_id'=>$this->event_id,
            'category_id'=>$this->category_id,
            'status'=>$this->status,
            'images'=>ImageResource::collection($this->getMedia('images')),
        ];
    }
}
