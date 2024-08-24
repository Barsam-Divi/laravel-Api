<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtistResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => new CategoryResources($this->category),
            'avatar' => $this->avatar,
            'background' => $this->background,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
