<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}" dir="auto">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'minbar')</title>

    <link rel="stylesheet" href="{{ asset('assets/fonts-6/css/all.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <!-- Add this before the aside/main section -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light d-md-none">

                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarMenu">
                    ☰ Menu
                </button>

            </nav>

            <!-- Sidebar (collapse on small screens) -->
            <aside id="sidebarMenu"
                class="col-md-2 col-lg-2 bg-light border-end collapse d-md-block min-vh-100  bg-secondary">
              <a href="{{route("/")}}" class="btn text text-center fs-3 d-block mt-5 mb-5">@lang("adminlayout.title")</a>
                <ul class="nav flex-column">
                    @if(auth()->id())
                        <li class="nav-item">
                        <a class="nav-link btn  {{ request()->routeIs('admin.room.index') ? 'active' : '' }}"
                            href="{{ route('admin.room.index') }}">@lang("adminlayout.room")</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn  {{ request()->routeIs('admin.item.index') ? 'active' : '' }}"
                            href="{{ route('admin.item.index') }}">@lang("adminlayout.items")</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn {{ request()->routeIs('admin.itemexpired.index') ? 'active' : '' }}"
                            href="{{ route('admin.itemexpired.index') }}">@lang("adminlayout.Item Expired")
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn {{ request()->routeIs('admin.standarInRoomMinibars.index') ? 'active' : '' }}"
                            href="{{ route('admin.standarInRoomMinibars.index') }}">@lang("adminlayout.Standard In Room")
                        </a>
                    </li>

    @endif
                    <li class="nav-item">
                        <a class="nav-link btn {{ request()->routeIs('user.addTheValidityOfTheItemsInTheRoom.index') ? 'active' : '' }}"
                            href="{{ route('user.addTheValidityOfTheItemsInTheRoom.index') }}">@lang("adminlayout.Validity of Items")</a>
                    </li>

     @if(auth()->id())
                    <li class="nav-item">

                        <a class="nav-link btn {{ request()->routeIs('user.addTheValidityOfTheItemsInTheRoom.changeditems') ? 'active' : '' }}"
                            href="{{ route('user.addTheValidityOfTheItemsInTheRoom.changeditems') }}">@lang("adminlayout.Changed Items")</a>
                    </li>

@endif




                </ul>
            </aside>

            <!-- Main content -->
            <main class="col-md-10 col-lg-10" style=" margin: 0; padding: 0;">



                <nav class="navbar navbar-expand-lg bg-body-tertiary ">
                    <div class="container">
                        <a class="navbar-brand" href="{{route("/")}}" >@lang("adminlayout.title")</a>
                        <form action="{{ route('locale.change') }}" method="POST">
                            @csrf
                            <select class="form-control" name="locale" onchange="this.form.submit()">
                                <option value="en" {{ app()->getLocale() == 'en' ? ' selected' : ''
                                    }}>English</option>
                                <option value="ar" {{ app()->getLocale() == 'ar' ? ' selected' : ''
                                    }}>العربية</option>
                                <!-- Additional language options -->
                            </select>
                        </form>
                        <!-- Desktop User Menu -->
                        @if(auth()->id())
                            <div class="dropdown ">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{auth()->user()->name}}
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <div class="grid flex-1 text-start text-sm leading-tight">
                                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                                </div>
                                            </a>
                                        </li>
                                        <hr>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button class="btn "><i class="fa-solid fa-right-from-bracket"></i>
                                                    @lang("adminlayout.Log Out")</button>
                                            </form>
                                        </li>

                                    </ul>
                        </div>

                        @endif


                    </div>
                </nav>

                <div class="container">
                    <h2 class="text text-center mt-3">@yield('title')</h2>
                    @yield('content')
                </div>

            </main>
        </div>


    </div><!-- jQuery (required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#roomNumber').select2({
            theme: 'bootstrap5',
            placeholder: "@lang('addTheValidityOfTheItemsInTheRoom.Choose a Room')",
              allowClear: true,
            width: 'resolve' // Ensures it respects the container's width
        });
    });
</script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/app.js') }}"></script>

</body>

</html>
