<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use Illuminate\Http\Request;

class AddRoom extends Controller
{
    public function create()
    {
        return view('admin.room.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'roomNumber' => 'required|integer|min:1|unique:rooms,roomNumber',
            'note' => 'nullable|string',
        ]);

        Rooms::create($validated);

        return redirect()->route('admin.room.create')->with('success', 'Room number added successfully!');
    }

    public function index()
    {
        $perPage = 10;
        $rooms = Rooms::paginate($perPage); // Assuming you have a Room model

        return view('admin.room.index', compact('rooms'));
    }

    public function edit($id)
{
    $room = Rooms::findOrFail($id);
    return view('admin.room.edit', compact('room'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'roomNumber' => 'required|integer|min:1|unique:rooms,roomNumber,' . $id,
        'note' => 'nullable|string'
    ]);

    $room = Rooms::findOrFail($id);
    $room->update($request->only('roomNumber', 'note'));

    return redirect()->route('admin.room.index')->with('success', 'Room updated successfully.');
}

public function destroy($id)
{
    $item = Rooms::findOrFail($id);
    $item->delete();

    return redirect()->route('admin.room.index')->with('success', 'Item deleted successfully.');
}
}
