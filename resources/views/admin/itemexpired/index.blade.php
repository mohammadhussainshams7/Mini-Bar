@extends("layouts.layoutAdmin")



@section("title")
@lang('itemexpired.title')
@endsection

@section('content')


<a class="btn btn-primary" href="{{ route("admin.itemexpired.create") }}"><i class="fas fa-plus"></i>
    @lang('itemexpired.Add Item Expired')</a>

<div class="table-responsive mt-2">
    <table class="table table-striped  table-bordered table-hover align-middle">
        <thead class="text text-center text-capitalize table-dark">

            <tr>
                <th> @lang('itemexpired.Id')</th>
                <th>@lang('itemexpired.Name Item')</th>
                <th>@lang('itemexpired.Item expiry After Day') </th>


                <th>@lang('itemexpired.Action')</th> <!-- New column -->



            </tr>
        </thead>
        <tbody dir="ltr" class="text text-center text-capitalize" >

            @foreach($itemexpired as $index => $item)
            <tr>
                <td scope="row">{{ $index + 1 }}</td>
                <td>{{ $item->item->name }}</td>
                <td>{{ $item->expiry_date }}</td>



                <td>
                    <a href="{{ route('admin.itemexpired.edit', $item->id) }}" class="btn btn-sm btn-warning"
                        title="Edit item expired">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.itemexpired.destroy', $item->id) }}" method="POST"
                        onsubmit="return confirm('@lang('itemexpired.MassageDelete') {{ $item->item->name }}?');"
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
    {{ $itemexpired->links() }}
</div>


@endsection
