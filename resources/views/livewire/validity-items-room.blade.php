<div>
    <div>


        <div class="row">

                <div class="col-md-6">            <a class="btn btn-primary mb-4" href="{{ route("user.addTheValidityOfTheItemsInTheRoom.create") }}"><i
                    class="fas fa-plus"></i> @lang('addTheValidityOfTheItemsInTheRoom.Add Validity Of The Items In The Room') </a>
</div>
                <div class="col-md-6">
                        <input type="text" wire:model.live="search" placeholder="@lang('addTheValidityOfTheItemsInTheRoom.Search by room number or item name')"
                class="border p-2 rounded w-100 float-end" />
                </div>
        </div>
        <div class="table-responsive mt-2">
            <table class="table table-striped  table-bordered table-hover align-middle">
                <thead class="text text-center text-capitalize table-dark">

                    <tr>
                        <th> @lang('addTheValidityOfTheItemsInTheRoom.Id')</th>
                        <th>@lang('addTheValidityOfTheItemsInTheRoom.Room Number')</th>
                        <th>@lang('addTheValidityOfTheItemsInTheRoom.Name Item')</th>
                        <th>@lang('addTheValidityOfTheItemsInTheRoom.Date of Manufacture')</th>
                        @if(auth()->id())
                        <th>@lang('addTheValidityOfTheItemsInTheRoom.Date of Expired')</th>
                        <th>@lang('addTheValidityOfTheItemsInTheRoom.Product duration in days')</th>
                        <th>@lang('addTheValidityOfTheItemsInTheRoom.Product Status')</th>
                        @endif
                        <th>@lang('addTheValidityOfTheItemsInTheRoom.Is changed')</th>
                        <th>@lang('addTheValidityOfTheItemsInTheRoom.Action')</th>
                    </tr>
                </thead>
                <tbody dir="ltr" class="text text-center text-capitalize">
                    @foreach($processedItems as $item)
                    <tr class="{{ $item['isExpired'] ? 'table-danger' : '' }}">
                        <td>{{ $item['index'] }}</td>
                        <td>{{ $item['roomNumber'] }}</td>
                        <td>{{ $item['itemName'] }}</td>
                        <td>{{ $item['manufactureDate'] }}</td>
                         @if(auth()->id())
                        <td>{{ $item['expiryDate'] }}</td>
                        <td>{{ $item['expiryDays'] ?? 'N/A' }}</td>
                        <td>
                            @if($item['isExpired'])
                            <span class="badge bg-danger">
                                @lang('addTheValidityOfTheItemsInTheRoom.Expired') {{ (int)$item['daysRemaining'] }}
                                @lang('addTheValidityOfTheItemsInTheRoom.days')
                            </span>
                            @elseif($item['daysRemaining'] !== null)
                            <span class="badge bg-success">
                                @lang('addTheValidityOfTheItemsInTheRoom.Valid for') {{ (int)$item['daysRemaining'] }}
                                @lang('addTheValidityOfTheItemsInTheRoom.days')
                            </span>
                            @else
                            <span class="badge bg-secondary">
                                @lang('addTheValidityOfTheItemsInTheRoom.No expiry data')
                            </span>
                            @endif
                        </td>
                        @endif

                        <td>
                            @if($item['isExpired'])
                            @if(auth()->id())
                            <form action="{{ route('user.addTheValidityOfTheItemsInTheRoom.destroy', $item['id']) }}"
                                method="POST"
                                onsubmit="return confirm('@lang('addTheValidityOfTheItemsInTheRoom.MassageDelete') {{ $item['itemName'] }} @lang('addTheValidityOfTheItemsInTheRoom.From room no') {{ $item['roomNumber'] }} ?');"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i
                                        class="fa-solid fa-check"></i></button>
                            </form>
                            @else
                            @lang("addTheValidityOfTheItemsInTheRoom.It needs to change")
                            @endif

                            @else
                            <span>@lang("addTheValidityOfTheItemsInTheRoom.Doesn't need to be changed")</span>
                            @endif

                        </td>
                        <td> <a href="{{ route('user.addTheValidityOfTheItemsInTheRoom.edit', $item['id']) }}"
                                class="btn btn-sm btn-warning" title="TheValidityOfTheItemsInTheRoom">
                                <i class="fas fa-edit"></i>
                            </a></td>
                    </tr>
                    @endforeach
                </tbody>


            </table>

        </div>

        <!-- Pagination Links -->
        <div class="m-1">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    {{-- Prev Button --}}
                    <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="?page={{ $currentPage - 1 }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span> {{-- Left double arrow --}}
                    </a>
                    </li>
                    {{-- Page Numbers --}}
                    @for ($i = 1; $i <= $lastPage; $i++)
                        <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                            <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Next Button --}}
                    <li class="page-item {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                    <a class="page-link" href="?page={{ $currentPage + 1 }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>

                </ul>
            </nav>

        </div>




    </div>
</div>
