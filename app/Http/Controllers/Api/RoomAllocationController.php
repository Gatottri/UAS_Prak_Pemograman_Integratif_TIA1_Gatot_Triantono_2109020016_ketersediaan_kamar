<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomAllocationRequest;
use Illuminate\Http\Request;
use App\Http\Resources\RoomAllocationResource;
use App\Models\RoomAllocation;
use App\Models\Room;    

class RoomAllocationController extends Controller
{
    public function index()
    {
        $roomallocations= RoomAllocation::all();
        return response()->json($roomallocations);
    }

    public function show($id)
    {
        $roomallocation = RoomAllocation::find($id);

        if (!$roomallocation) {
            return response()->json(['error' => 'Room not found'], 404);
        }

        return new RoomAllocationResource($roomallocation);
    }

    public function store(Request $request)
    {
        $roomallocation = RoomAllocation::create($request->all());
        $validatedData = $request->validate([
            'patient_id' => 'required|integer',
            'room_id' => 'required|integer',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            // add other validations as needed
        ]);
        
        $roomallocation = new RoomAllocation();
        $roomallocation->room_id = $validatedData['room_id'];
        $roomallocation->patient_id = $validatedData['patient_id'];
        $roomallocation->check_in = $validatedData['check_in'];
        $roomallocation->check_out = $validatedData['check_out'];
        $roomallocation->save();
    
        return response()->json(['message' => 'Room found it !']);
    }

    public function checkOut($id)
    {
        $roomallocation = RoomAllocation::find($id);

        if (!$roomallocation) {
            return response()->json(['error' => 'Room not found'], 404);
        }

        $roomallocation->check_out = now();
        $roomallocation->save();

        $room = Room::find($roomallocation->room_id);
        if ($room) {
            $room->status = true;
            $room->save();
        }

        return response()->json($roomallocation);
    }

    public function update(RoomAllocationRequest $request, $id)
    {
        $roomallocation = RoomAllocation::findOrFail($id);

        $validatedData = $request->validated();

        $roomallocation->update($validatedData);

        return response()->json($roomallocation);
    }
}
