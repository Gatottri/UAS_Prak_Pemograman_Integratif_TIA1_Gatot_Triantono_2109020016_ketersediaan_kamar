<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomAllocationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'room_id' => 'required|exists:rooms,id',
            'patient_id' => 'required|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ];
    }
}
