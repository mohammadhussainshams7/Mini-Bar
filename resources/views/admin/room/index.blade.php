@extends("layouts.layoutAdmin")



@section("title")
@lang('room.title')

@endsection

@section('content')


<a class="btn btn-primary" href="{{ route('admin.room.create') }}">
    <i class="fas fa-plus"></i> @lang('room.Add Room')
</a>

<div class="table-responsive mt-2">
    <table class="table table-striped  table-bordered table-hover align-middle">
        <thead class="text text-center text-capitalize table-dark">
            <tr>
                <th>@lang('room.Id')</th>
                <th>@lang('room.Room Number')</th>
                <th>@lang('room.Note')</th>
                <th>@lang('room.Action')</th> <!-- New column -->
            </tr>
        </thead>
        <tbody dir="ltr" class="text text-center text-capitalize" >
            @foreach($rooms as $index => $room)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $room->roomNumber }}</td>
                <td>{{ $room->note }}</td>


                <td>
                    <a href="{{ route('admin.room.edit', $room->id) }}" class="btn btn-sm btn-warning"
                        title="Edit Room">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.room.destroy', $room->id) }}" method="POST"
                        onsubmit="return confirm('@lang('room.MassageDelete') {{ $room->roomNumber}}');"
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
    {{ $rooms->links() }}
</div>
@endsection
