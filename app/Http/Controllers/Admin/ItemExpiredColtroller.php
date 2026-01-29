<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemExpired;
use App\Models\Items;
use Illuminate\Http\Request;

class ItemExpiredColtroller extends Controller
{
    public function create()
    {
        $useditemsIds = ItemExpired::distinct()->pluck('item_id')->toArray();

        // Only show Items that are NOT already used
        $allItems = Items::whereNotIn('id', $useditemsIds)->get();


        return view('admin.itemexpired.create', compact('allItems'));
    }



    public function store(Request $request)
    {
      $validated = $request->validate([
            'item_id' => 'required|integer|min:1|unique:item_expireds,item_id',
            'expiry_date' => 'required|integer|min:1',
        ]);
        //'name' => 'required|string|min:1|unique:items,name'

        // Example: Save to DB later if you have item model
        ItemExpired::create($validated);

        return redirect()->route('admin.itemexpired.create')->with('success', 'itemexpired added successfully!');
    }





    public function index()
    {
        $perPage = 10;
        $itemexpired = ItemExpired::with('item')->paginate($perPage);; // Assuming you have a ItemExpired and ItemExpired Relashionships  model

        return view('admin.itemexpired.index', compact('itemexpired'));
    }







          public function edit($id)
    {
        $itemexpired = ItemExpired::with('item')->findOrFail($id);
        return view('admin.itemexpired.edit', compact('itemexpired'));
    }





    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'item_id' => 'required|integer|min:1',
            'expiry_date' => 'required|integer|min:1',
        ]);

        $item = ItemExpired::findOrFail($id);
        $item->update($request->only('item_id', 'expiry_date'));

        return redirect()->route('admin.itemexpired.index')->with('success', 'item updated successfully.');
    }





    public function destroy($id)
    {
        $item = ItemExpired::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.itemexpired.index')->with('success', 'Item deleted successfully.');
    }
}
