<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'room_number' => 'required|unique:rooms,room_number|string|max:255',
            'level' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|boolean',
        ];
    }
}
