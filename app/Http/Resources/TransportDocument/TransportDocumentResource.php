<?php

namespace App\Http\Resources\TransportDocument;

use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;

class TransportDocumentResource extends SuccessResource
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
