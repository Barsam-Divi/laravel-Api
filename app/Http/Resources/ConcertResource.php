<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConcertResource extends JsonResource
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
            'artist' => new ArtistResources($this->artist),
            'hall' => new HallResource($this->hall),
            'title' => $this->title,
            'description' => $this->description,
            'started_at'  => $this->started_at->format('Y-m-d'),
            'end_at' => $this->end_at->format('Y-m-d'),
            'published' => $this->published
        ];
    }
}
