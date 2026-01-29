<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Items;



class ItemsController extends Controller
{

     public function create() {
        return view('admin.item.create');
    }



        public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:1|unique:items,name',
            "dependency" =>"required|string"
        ]);


        // Example: Save to DB later if you have item model
        Items::create($validated);

        return redirect()->route('admin.item.create')->with('success', 'Item added successfully!');
    }

    public function index()
    {
        $perPage = 10;
        $items = Items::paginate($perPage);
        return view('admin.item.index', compact('items'));
    }


        public function edit($id)
    {
        $item = Items::findOrFail($id);
        return view('admin.item.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
           $validated = $request->validate([
            'name' => 'required|string|min:1',
            "dependency" =>"required|string"
        ]);

        $item = Items::findOrFail($id);
        $item->update($request->only('name', 'dependency'));

        return redirect()->route('admin.item.index')->with('success', 'item updated successfully.');
    }

    public function destroy($id)
    {
        $item = Items::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.item.index')->with('success', 'Item deleted successfully.');
    }
}
