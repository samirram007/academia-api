<?php

namespace App\Http\Resources\Room;

use Illuminate\Http\Request;
use App\Http\Resources\Floor\FloorResource;
use App\Http\Resources\SuccessResource;
class RoomResource extends SuccessResource
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
            'code' => $this->code,
            'floor_id' => $this->floor_id,
            'capacity' => $this->capacity,
            'floor' => new FloorResource($this->whenLoaded('floor')),
            'room_type' => $this->room_type,
        ];
    }
}
