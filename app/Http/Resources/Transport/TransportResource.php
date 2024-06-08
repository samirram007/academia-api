<?php

namespace App\Http\Resources\Transport;

use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;

class TransportResource extends SuccessResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
