
@extends("layouts.layoutAdmin")



@section("title")
@lang('room.Change Room Number')
@endsection
@section('content')


<div class="container mt-5">



    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.room.update', $room->id )}}" method="POST" class="card p-4 shadow-sm">
   @csrf
    @method('PUT')
    <div class="mb-3">
            <label for="roomNumber" class="form-label">@lang("room.Room Number")</label>
            <input type="number" name="roomNumber" id="roomNumber"  value="{{ old('roomNumber', $room->roomNumber) }}"  class="form-control" required>
            @error('roomNumber')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>


            <div class="mb-3">
            <label for="note" class="form-label">@lang('room.Note')</label>
            <input type="text" name="note" id="note" class="form-control" value="{{ old('note', $room->note) }}">
            @error('note')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">@lang('room.Update Room')</button>
    </form>
</div>

@endsection
