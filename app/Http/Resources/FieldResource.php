<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FieldResource extends JsonResource
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
            'label' => $this->label,
            'name' => $this->name,
            'type' => $this->type,
            'answers_count' => $this->answers->count(),
            'created_at' => date('d.m.Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d.m.Y H:i:s', strtotime($this->updated_at)),
        ];
    }
}
