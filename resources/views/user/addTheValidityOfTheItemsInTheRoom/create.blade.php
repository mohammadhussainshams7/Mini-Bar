@extends('layouts.layoutAdmin')

@section('title')
@lang('addTheValidityOfTheItemsInTheRoom.Add Validity Of The Items In The Room')
@endsection

@section('content')
<style>
    .select2-selection__placeholder {
        padding: 8px;
        font-size: 16px;
    }
    .select2-container {
        width: 100% !important;
    }
    .item-card {
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .item-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .btn-date {
        margin-bottom: 0.5rem;
    }
</style>

<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('user.addTheValidityOfTheItemsInTheRoom.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        {{-- Room Selection --}}
        <div class="mb-4">
            <select name="room_id" class="form-control select2" required>
                <option value="">@lang('addTheValidityOfTheItemsInTheRoom.Room Number')</option>
                @foreach ($allRooms as $item)
                    <option value="{{ $item->id }}">{{ $item->roomNumber }}</option>
                @endforeach
            </select>
            @error('room_id')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Items --}}
        @php
            use Carbon\Carbon;
            if (App::currentLocale() == "ar") {
                Carbon::setLocale('ar');
            }
            $end = Carbon::now()->startOfMonth();
            $start = $end->copy()->subYear();
        @endphp

        @foreach ($allItems as $index => $item)
        <div class="item-card">
            <input type="hidden" name="items[{{ $index }}][standar_in_room_minibar_id]" value="{{ $item->id }}">
            
            <label class="item-label">
                @lang("addTheValidityOfTheItemsInTheRoom.Production date") <b>{{ $item->item->name }}</b>
            </label>

            <div class="row g-2">
                @for ($date = $start->copy(); $date->lte($end); $date->addMonth())
                <div class="col-md-3 col-sm-4 col-6">
                    <input type="radio"
                           class="btn-check"
                           name="items[{{ $index }}][date_of_manufacture]"
                           id="date_{{ $date->format('Ym') }}_{{ $index }}"
                           value="{{ $date->format('Y-m-d') }}"
                           autocomplete="off">
                    <label class="btn btn-outline-primary btn-date w-100" for="date_{{ $date->format('Ym') }}_{{ $index }}">
                        {{ $date->translatedFormat('d M Y') }}
                    </label>
                </div>
                @endfor
            </div>

            @error("items.{$index}.date_of_manufacture")
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary btn-lg w-100 mt-3">@lang('addTheValidityOfTheItemsInTheRoom.Add')</button>
    </form>
</div>
@endsection
