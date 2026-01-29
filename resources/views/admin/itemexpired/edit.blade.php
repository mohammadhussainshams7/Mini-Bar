@extends('layouts.layoutAdmin')



@section('title')
    @lang("itemexpired.update Item Expired")
@endsection

@section('content')


<div class="container mt-5">



    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.itemexpired.update',  $itemexpired->id) }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')
        <div class="mb-3">

<select class="form-select" aria-label="Default select example">
        <option value="{{ $itemexpired->item_id }}">
            {{ $itemexpired->item->name }}
        </option>
</select>

<input type="hidden" name="item_id" value="{{ $itemexpired->item_id }}">

            @error('item_id')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>



        <div class="mb-3">
            <label for="expiry_date" class="form-label"> @lang("itemexpired.Item expiry After Day")</label>
            <input type="number" min="1" name="expiry_date" value="{{ old('expiry_date', $itemexpired->expiry_date) }}"
                id="expiry_date" class="form-control" required>
            @error('expiry_date')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>





        <button type="submit" class="btn btn-primary">    @lang("itemexpired.update") </button>
    </form>
</div>

@endsection
