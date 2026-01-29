@extends('layouts.layoutAdmin')



@section('title')
     @lang('standardInRoomMinibar.Add New Standard In Room Minibar')
@endsection
@section('content')


<div class="container mt-5">



    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.standarInRoomMinibars.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="item_id" class="form-label">@lang('standardInRoomMinibar.Select Item')</label>
            <select class="form-select" aria-label="Default select example" name="item_id">
                <option value="" disabled selected>@lang('standardInRoomMinibar.Choose item')...</option>
                @foreach ($allItems as $index => $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>

            @error('item_id')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">@lang('standardInRoomMinibar.Add')</button>
    </form>
</div>

@endsection
