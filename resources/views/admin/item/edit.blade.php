
@extends("layouts.layoutAdmin")



@section("title")
@lang("item.update Item")
@endsection

@section('content')


<div class="container mt-5">



    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.item.update', $item->id) }}" method="POST" class="card p-4 shadow-sm">
   @csrf
       @method('PUT')
    <div class="mb-3">
            <label for="name" class="form-label">@lang("item.Change Item Name")</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $item->name) }}"  required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>


            <div class="mb-3">




        <select class="form-select" aria-label="Default select example" name="dependency">
            <option value="" disabled {{ old('dependency', $item->dependency ?? '') === '' ? 'selected' : '' }}>@lang("item.Dependency")</option>
            <option value="food" {{ old('dependency', $item->dependency ?? '') === 'food' ? 'selected' : '' }}>@lang("item.Food")</option>
            <option value="beverage" {{ old('dependency', $item->dependency ?? '') === 'beverage' ? 'selected' : '' }}>@lang("item.Beverage")</option>
        </select>




            @error('dependency')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">@lang("item.update")</button>
    </form>
</div>

@endsection
