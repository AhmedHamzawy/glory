<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Eduyear extends JsonResource
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
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
            'year' => $this->year,
            'semester' => $this->semester
        ];
    }
}
