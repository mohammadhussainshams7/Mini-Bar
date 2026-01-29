@extends('layouts.layoutAdmin')



@section('title')
    @lang('itemexpired.Add New Item Expired')
@endsection

@section('content')


    <div class="container mt-5">



        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.itemexpired.store') }}" method="POST" class="card p-4 shadow-sm">
            @csrf

            <div class="mb-3">




                <select class="form-select" aria-label="Default select example" name="item_id">
                    <option selected>chose item....</option>
                    @foreach ($allItems as $index => $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>




                @error('item_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>



            <div class="mb-3">
                <label for="expiry_date" class="form-label">@lang('itemexpired.Item expiry After Day')</label>
                <input type="number" min="1" name="expiry_date" id="expiry_date" class="form-control" required>
                @error('expiry_date')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>





            <button type="submit" class="btn btn-primary">@lang('itemexpired.Add')</button>
        </form>
    </div>

@endsection
