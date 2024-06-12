<?php

namespace App\Http\Resources\TransportUser;

use App\Http\Resources\Document\DocumentResource;
use App\Http\Resources\JourneyType\JourneyTypeResource;
use App\Http\Resources\StudentSession\StudentSessionResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\Transport\TransportResource;
use App\Http\Resources\User\UserResource;
use App\Models\TransportPickupDrop;
use Illuminate\Http\Request;

class TransportSearchUserResource extends SuccessResource
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

        ];
    }
}
