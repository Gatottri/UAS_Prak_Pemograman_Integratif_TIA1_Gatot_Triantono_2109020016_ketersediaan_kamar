<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class RoomAllocationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'room_id' => $this->room_id,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            // add any other attributes you need
        ];
    }
}
