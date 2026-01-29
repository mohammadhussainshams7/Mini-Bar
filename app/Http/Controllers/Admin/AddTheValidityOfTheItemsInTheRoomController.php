<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddTheValidityOfTheItemsInTheRoom;
use App\Models\ItemExpired;
use App\Models\Rooms;
use App\Models\StandarInRoomMinibars;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AddTheValidityOfTheItemsInTheRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $perPage = 10;
        $addTheValidityOfTheItemsInTheRoom = AddTheValidityOfTheItemsInTheRoom::with(['standarinroomminibar.item', 'room'])->paginate($perPage);
        $itemExpired = ItemExpired::with('item')->get(); // This returns a COLLECTION
        $now = Carbon::now();

        $processedItems = $addTheValidityOfTheItemsInTheRoom->map(function ($item, $index) use ($itemExpired, $now) {
            $itemData = $item->standarinroomminibar->item ?? null;

            $manufactureDate = $item->date_of_manufacture
                ? Carbon::createFromFormat('Y-m-d', $item->date_of_manufacture)
                : null;

            $expiryDays = null;
            $expiryDate = null;
            $isExpired = false;
            $daysRemaining = null;

            if ($itemData && $manufactureDate) {
                // Match expiry rule by item_id
                $matchedExpiry = $itemExpired->firstWhere('item_id', $itemData->id);

                if ($matchedExpiry) {
                    $expiryDays = $matchedExpiry->expiry_date;
                    $expiryDate = $manufactureDate->copy()->addDays($expiryDays);

                    if ($expiryDate->isPast()) {
                        $isExpired = true;
                        $daysRemaining = $expiryDate->diffInDays($now);
                    } else {
                        $daysRemaining = $now->diffInDays($expiryDate);
                    }
                }
            }

            return [
                'id' => $item->id,
                'index' => $index + 1,
                'roomNumber' => $item->room->roomNumber ?? 'N/A',
                'itemName' => $itemData->name ?? 'N/A',
                'manufactureDate' => $item->date_of_manufacture ?? 'N/A',
                'expiryDays' => $expiryDays,
                'expiryDate' => $expiryDate ? $expiryDate->format('Y-m-d') : 'N/A',
                'isExpired' => $isExpired,
                'daysRemaining' => $daysRemaining,
            ];
        });

        return view('user.addTheValidityOfTheItemsInTheRoom.index', [
            'processedItems' => $processedItems,
            'addTheValidityOfTheItemsInTheRoom' => $addTheValidityOfTheItemsInTheRoom,
        ]);
    }

    public function changeditems()
    {
        $perPage = 10; // or any value you want for pagination

        $trashed = AddTheValidityOfTheItemsInTheRoom::onlyTrashed()
            ->with(['standarinroomminibar.item', 'room'])
            ->paginate($perPage);

        $itemExpired = ItemExpired::with('item')->get(); // This returns a COLLECTION

        $now = Carbon::now();

        $processedItems = $trashed->map(function ($item, $index) use ($itemExpired, $now) {
            $itemData = $item->standarinroomminibar->item ?? null;

            $manufactureDate = $item->date_of_manufacture
                ? Carbon::createFromFormat('Y-m-d', $item->date_of_manufacture)
                : null;

            $expiryDays = null;
            $expiryDate = null;
            $isExpired = false;
            $daysRemaining = null;

            if ($itemData && $manufactureDate) {
                // Match expiry rule by item_id
                $matchedExpiry = $itemExpired->firstWhere('item_id', $itemData->id);

                if ($matchedExpiry) {
                    $expiryDays = $matchedExpiry->expiry_date;
                    $expiryDate = $manufactureDate->copy()->addDays($expiryDays);

                    if ($expiryDate->isPast()) {
                        $isExpired = true;
                        $daysRemaining = $expiryDate->diffInDays($now);
                    } else {
                        $daysRemaining = $now->diffInDays($expiryDate);
                    }
                }
            }

            return [
                'id' => $item->id,
                'index' => $index + 1,
                'roomNumber' => $item->room->roomNumber ?? 'N/A',
                'itemName' => $itemData->name ?? 'N/A',
                'manufactureDate' => $item->date_of_manufacture ?? 'N/A',
                'expiryDays' => $expiryDays,
                'expiryDate' => $expiryDate ? $expiryDate->format('Y-m-d') : 'N/A',
                'isExpired' => $isExpired,
                'daysRemaining' => $daysRemaining,
                'deleted_at' => $item->deleted_at,
            ];
        });

        return view('user.addTheValidityOfTheItemsInTheRoom.changeditems', [
            'processedItems' => $processedItems,
            'trashed' => $trashed,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usedRoomIds = AddTheValidityOfTheItemsInTheRoom::distinct()->pluck('room_id')->toArray();

        $allItems = StandarInRoomMinibars::with('item')->get();

        // Only show rooms that are NOT already used
        $allRooms = Rooms::whereNotIn('id', $usedRoomIds)->get();

        return view('user.addTheValidityOfTheItemsInTheRoom.create', compact('allItems', 'allRooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'items' => 'required|array',
            'items.*.date_of_manufacture' => 'required|date',
            'items.*.standar_in_room_minibar_id' => 'required|exists:standar_in_room_minibars,id',
        ]);

        foreach ($validated['items'] as $item) {
            AddTheValidityOfTheItemsInTheRoom::updateOrCreate(
                [
                    'room_id' => $request->room_id,
                    'standar_in_room_minibar_id' => $item['standar_in_room_minibar_id'],
                ],
                [
                    'date_of_manufacture' => $item['date_of_manufacture'],
                ]
            );
        }

        return redirect()->route('user.addTheValidityOfTheItemsInTheRoom.create')->with('success', 'Add The Validity Of The Items In The Room added successfully!');

    }

    public function edit($id)
    {
        $addTheValidityOfTheItemsInTheRoom = AddTheValidityOfTheItemsInTheRoom::with('room', 'standarinroomminibar.item')->findOrFail($id);

        // dd( $addTheValidityOfTheItemsInTheRoom);
        return view('user.addTheValidityOfTheItemsInTheRoom.edit', compact('addTheValidityOfTheItemsInTheRoom'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'room_id' => 'required|integer|min:1',
            'date_of_manufacture' => 'required|date',
        ]);

        $item = AddTheValidityOfTheItemsInTheRoom::findOrFail($id);
        $item->update($request->only('room_id', 'date_of_manufacture'));

        return redirect()->route('user.addTheValidityOfTheItemsInTheRoom.index')->with('success', 'item updated successfully.');
    }

    public function destroy($id)
    {
        $item = AddTheValidityOfTheItemsInTheRoom::findOrFail($id);

        $item->delete();

        return redirect()->route('user.addTheValidityOfTheItemsInTheRoom.index')->with('success', 'Item deleted successfully.');
    }
}
