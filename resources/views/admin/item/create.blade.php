
@extends("layouts.layoutAdmin")



@section("title")
    @lang("item.Add New Item")
@endsection

@section('content')


<div class="container mt-5">



    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.item.store') }}" method="POST" class="card p-4 shadow-sm">
   @csrf
    <div class="mb-3">
            <label for="name" class="form-label">@lang("item.Name New Item")</label>
            <input dir="ltr" type="text" name="name" id="name" class="form-control" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>


            <div class="mb-3">




            <select class="form-select" aria-label="Default select example" name="dependency">
            <option selected>@lang('item.Dependency')</option>
            <option value="food">@lang('item.Food')</option>
            <option value="beverage">@lang('item.Beverage')</option>
            </select>




            @error('dependency')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">@lang('item.Add')</button>
    </form>
</div>

@endsection
