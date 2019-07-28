<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Subject extends JsonResource
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
            'room' => $this->room,
            'professor' => $this->professor,
            'assistant' => $this->assistant,
            'description' => $this->description,
            'min_mark' => $this->min_mark,
            'max_mark' => $this->max_name,
            'pass_mark' => $this->pass_name,
            'type' => $this->type,
        ];
    }
}
