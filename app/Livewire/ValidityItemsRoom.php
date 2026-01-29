<?php

namespace App\Livewire;

use App\Models\AddTheValidityOfTheItemsInTheRoom;
use App\Models\ItemExpired;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
class ValidityItemsRoom extends Component
{
        use WithPagination, WithoutUrlPagination;

    public $perPage = 10;
    public $search = '';

    protected $updatesQueryString = ['search']; // Optional: allow URL sharing with search


    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination when search is updated
    }

    public function render()
    {
        $query = AddTheValidityOfTheItemsInTheRoom::with(['standarinroomminibar.item', 'room'])->orderBy('created_at','desc');
      if ($this->search) {
        $query->where(function ($q) {
            $q->whereHas('standarinroomminibar.item', function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('room', function ($subQuery) {
                $subQuery->where('roomNumber', 'like', '%' . $this->search . '%');
            });
        });



        }

        $addTheValidityOfTheItemsInTheRoom = $query->paginate($this->perPage);

        $itemExpired = ItemExpired::with('item')->get();
        $now = Carbon::now();

        $processedItems = $addTheValidityOfTheItemsInTheRoom->map(function ($item, $index) use ($itemExpired, $now) {
            $itemData = $item->standarinroomminibar->item ?? null;
            $manufactureDate = $item->date_of_manufacture ? Carbon::createFromFormat('Y-m-d', $item->date_of_manufacture) : null;

            $expiryDays = null;
            $expiryDate = null;
            $isExpired = false;
            $daysRemaining = null;

            if ($itemData && $manufactureDate) {
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

        return view('livewire.validity-items-room', [
            'processedItems' => $processedItems,
            'addTheValidityOfTheItemsInTheRoom' => $addTheValidityOfTheItemsInTheRoom,
        ]);
    }
    }
