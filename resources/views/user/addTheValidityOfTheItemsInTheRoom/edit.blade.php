@extends('layouts.layoutAdmin')



@section('title')
@lang('addTheValidityOfTheItemsInTheRoom.update Validity Of The Items In The Room')
@endsection
@section('content')


<div class="container mt-5">


    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('user.addTheValidityOfTheItemsInTheRoom.update',$addTheValidityOfTheItemsInTheRoom->id) }}" method="POST"
        class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">


        <div class="mb-3">
    <label for="roomNumber">@lang('addTheValidityOfTheItemsInTheRoom.Room Number') <b>{{$addTheValidityOfTheItemsInTheRoom->room->roomNumber}}</b></label>

    <input type="text" hidden value="{{$addTheValidityOfTheItemsInTheRoom->room->id}}" name="room_id" id="roomNumber" class="form-control">
    @error('room_id')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

        <div class="mb-3">
    <label for="date_of_manufacture">@lang("addTheValidityOfTheItemsInTheRoom.Production date") <b>{{$addTheValidityOfTheItemsInTheRoom->standarinroomminibar->item->name}}</b></label>
    <input type="date"  value="{{$addTheValidityOfTheItemsInTheRoom->date_of_manufacture}}" name="date_of_manufacture" id="date_of_manufacture" class="form-control">
    @error('room_id')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>












        </div>




        <button type="submit" class="btn btn-primary">@lang('addTheValidityOfTheItemsInTheRoom.update')</button>
    </form>
</div>

@endsection
