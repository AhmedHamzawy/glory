<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Exam extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'mark' => $this->mark
        ];
    }
}
