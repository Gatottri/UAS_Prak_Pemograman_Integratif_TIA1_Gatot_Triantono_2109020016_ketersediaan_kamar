<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use Illuminate\Http\Request;
use App\Http\Requests\RoomRequest;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->paginate(5);

        //return collection of posts as a resource
        return new RoomResource(true, 'List Data Rooms', $rooms);
    }

    public function show($id)
    {
        $rooms = Room::find($id);

        //return single post as a resource
        return new RoomResource(true, 'Room Data Details', $rooms);
    }

    public function store(RoomRequest $request)
    {
        $room = Room::create($request->validated());
        return response()->json($room, 201);
    }

    public function updateStatus(Request $request,$id)
    {
        $validatedData = $request->validate([
            'status' => 'required|boolean',
        ]);

        $room = Room::findOrFail($id);
        $room->status = $validatedData['status'];
        $room->save();
        return response()->json(['message' => 'Room status updated successfully', 'room' => $room]);
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        // Validate the request if needed
        $request->validate([
            'room_number' => 'required|string|max:255|unique:rooms,room_number,'.$id,
            'level' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            // Add other validations as needed
        ]);

        // Update room data
        $room->update($request->all());

        return response()->json($room);
    }
}