<?php

namespace App\Http\Resources\FeeTemplateDetails;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeeTemplateDetailsResource extends JsonResource
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
            'is_active'=>$this->is_active,
            'sort_index'=>$this->sort_index,
            'amount'=>$this->amount,
            'is_customizable'=>$this->is_customizable,
            'keep_periodic_details'=>$this->keep_periodic_details,
            'fee_template'=>$this->fee_template,
            'fee_head'=>$this->fee_head,

        ];
    }
}
