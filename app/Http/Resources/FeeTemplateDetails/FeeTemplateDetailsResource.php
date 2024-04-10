<?php

namespace App\Http\Resources\FeeTemplateDetails;

use Illuminate\Http\Request;
use App\Http\Resources\FeeHead\FeeHeadResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FeeTemplate\FeeTemplateResource;

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
            'fee_template_id'=>$this->fee_template_id,
            'fee_head_id'=>$this->fee_head_id,
            'fee_template'=>new FeeTemplateResource($this->whenLoaded('fee_template')) ,
            'fee_head'=>new FeeHeadResource($this->whenLoaded('fee_head'))  ,

        ];
    }
}
