<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Setting extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'name' => $this->name,
            'address' => $this->address,
            'town' => $this->town,
            'county' => $this->county,
            'post_code' => $this->post_code,
            'country' => $this->country,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'website' => $this->website,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
        ];
    }
}
