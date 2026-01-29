@extends("layouts.layoutAdmin")



@section("title")
    @lang('addTheValidityOfTheItemsInTheRoom.title')
@endsection

@section('content')

    @livewireStyles


<livewire:validity-items-room />



@livewireScripts
@endsection
