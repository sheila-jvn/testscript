<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Api extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_user' => $this->id_user,
            'type' => $this->type,
            'is_approve' => $this->is_approve,
            'waktu' => $this->waktu,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
