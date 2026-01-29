<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\StandarInRoomMinibars;
use Illuminate\Http\Request;

class StandarInRoomMinibarsController extends Controller
{
    public function create()
    {
        $allItems = Items::all();
        $standarInRoomMinibars = StandarInRoomMinibars::with('item')->get();

        return view('admin.standarInRoomMinibars.create', compact('allItems','standarInRoomMinibars'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'item_id' => 'required|numeric|min:1',
        ]);

        // Example: Save to DB later if you have item model
        StandarInRoomMinibars::create($validated);

        return redirect()->route('admin.standarInRoomMinibars.create')->with('success', 'standarInRoomMinibars added successfully!');
    }

    public function index()
    {
        $perPage = 10;
        $standarInRoomMinibars = StandarInRoomMinibars::with('item')->paginate($perPage);// Assuming you have a standarInRoomMinibars and ItemExpired Relashionships  model

        return view('admin.standarInRoomMinibars.index', compact('standarInRoomMinibars'));
    }



    public function destroy($id)
    {
        $item = StandarInRoomMinibars::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.standarInRoomMinibars.index')->with('success', 'Item deleted successfully.');
    }

}
