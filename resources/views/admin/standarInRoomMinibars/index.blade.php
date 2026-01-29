@extends("layouts.layoutAdmin")



@section("title")
@lang('standardInRoomMinibar.title')
@endsection

@section('content')


<a class="btn btn-primary" href="{{ route("admin.standarInRoomMinibars.create") }}"> <i class="fas fa-plus"></i>
    @lang('standardInRoomMinibar.Add Standard In Room Minibar')</a>

<div class="table-responsive mt-2">
    <table class="table table-striped  table-bordered table-hover align-middle">
        <thead class="text text-center text-capitalize table-dark">
            <tr>
                <th> @lang('standardInRoomMinibar.Id')
                </th>
                <th> @lang('standardInRoomMinibar.Name Item')</th>
                <th> @lang('standardInRoomMinibar.Action')</th>

            </tr>
        </thead>
        <tbody dir="ltr" class="text text-center text-capitalize" >

            @foreach($standarInRoomMinibars as $index => $item)
            <tr>
                <td scope="row">{{ $index + 1 }}</td>
                <td>{{ $item->item->name }}</td>
                <td>

                    <form action="{{ route('admin.standarInRoomMinibars.destroy', $item->id) }}" method="POST"
                        onsubmit="return confirm('@lang('standardInRoomMinibar.MassageDelete') {{$item->item->name}}?');"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></button>
                    </form>

                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>



<!-- Pagination Links -->
<div>
    {{ $standarInRoomMinibars->links() }}
</div>

@endsection
