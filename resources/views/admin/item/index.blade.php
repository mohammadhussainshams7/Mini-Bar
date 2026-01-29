@extends("layouts.layoutAdmin")



@section("title")
@lang("item.title")
@endsection

@section('content')


<a class="btn btn-primary" href="{{ route("admin.item.create") }}"><i class="fas fa-plus"></i> @lang("item.Add Item")</a>
<div class="table-responsive mt-2">
    <table class="table table-striped  table-bordered table-hover align-middle">
        <thead class="text text-center text-capitalize table-dark">
            <tr>
                <th> @lang("item.Id")
                </th>
                <th> @lang("item.Name Item")</th>
                <th> @lang("item.Dependency")</th>
                <th> @lang("item.Action")</th> <!-- New column -->

            </tr>
        </thead>
        <tbody dir="ltr" class="text text-center text-capitalize" >

            @foreach($items as $index => $item)
            <tr>
                <td scope="row">{{ $index + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->dependency }}</td>
                <td>
                    <a href="{{ route('admin.item.edit', $item->id) }}" class="btn btn-sm btn-warning"
                        title="Edit item">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.item.destroy', $item->id) }}" method="POST"
                        onsubmit="return confirm('@lang('item.MassageDelete')  {{ $item->name }}');"
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
    {{ $items->links() }}
</div>





@endsection
