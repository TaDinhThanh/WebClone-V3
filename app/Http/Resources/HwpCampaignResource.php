<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HwpCampaignResource extends JsonResource
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
            'id' => $this->id,
            'value' => $this->campaign,
            'label' => $this->campaign,
            'language' => $this->language,
            'check' => $this->check,
        ];
    }
}
