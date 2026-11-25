<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'type'         => $this->type,
            'title'        => $this->title,
            'year'         => $this->year,
            'rating'       => $this->rating,
            'is_available' => $this->is_available,
            'episodes'     => $this->when($this->type === 'anime', $this->episodes),
            'studio'       => $this->when($this->type === 'anime', $this->studio),
            'duration'     => $this->when($this->type === 'film', $this->duration),
            'director'     => $this->when($this->type === 'film', $this->director),
            'users'        => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
