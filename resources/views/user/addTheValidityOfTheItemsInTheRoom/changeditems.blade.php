@extends("layouts.layoutAdmin")



@section("title")
@lang("changeditems.title")
@endsection

@section('content')


<div class="table-responsive mt-2">
    <table class="table table-striped  table-bordered table-hover align-middle">
        <thead class="text text-center text-capitalize table-dark">
        <tr>
            <th>@lang("changeditems.Id")</th>
            <th>@lang("changeditems.Room Number")</th>
            <th>@lang("changeditems.Name Item")</th>
            <th>@lang("changeditems.Date of Manufacture")</th>
            <th>@lang("changeditems.Date of Expired")</th>
            <th>@lang("changeditems.Product duration in days")</th>
            <th>@lang("changeditems.changet at")</th>
            <th>@lang("changeditems.Product Status")</th>
            <th>@lang("changeditems.The product has been changed")</th>

        </tr>
    </thead>


     <tbody dir="ltr" class="text text-center text-capitalize">
    @foreach($processedItems as $item)
        <tr class="bg-success">
            <td>{{ $item['index'] }}</td>
            <td>{{ $item['roomNumber'] }}</td>
            <td>{{ $item['itemName'] }}</td>
            <td>{{ $item['manufactureDate'] }}</td>
            <td>{{ $item['expiryDate'] }}</td>
            <td>{{ $item['expiryDays'] ?? 'N/A' }}</td>
            <td>{{$item['deleted_at']}}</td>
            <td >
                @if($item['isExpired'])
                    <span class="badge bg-danger">
                        @lang('addTheValidityOfTheItemsInTheRoom.Expired') {{ (int)$item['daysRemaining'] }} @lang('addTheValidityOfTheItemsInTheRoom.days')
                    </span>
                @elseif($item['daysRemaining'] !== null)
                    <span class="badge bg-success">
                        @lang('addTheValidityOfTheItemsInTheRoom.Valid for') {{ (int)$item['daysRemaining'] }} @lang('addTheValidityOfTheItemsInTheRoom.days')
                    </span>
                @else
                    <span class="badge bg-secondary">
                        @lang('addTheValidityOfTheItemsInTheRoom.No expiry data')
                    </span>
                @endif
            </td>

            <td >@lang("changeditems.yes")</td>
        </tr>
    @endforeach
</tbody>

</table>


</div>

<!-- Pagination Links -->
<div>
    {{ $trashed->links() }}
</div>
@endsection
