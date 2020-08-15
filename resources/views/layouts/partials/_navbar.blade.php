<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}  <img src="https://image.flaticon.com/icons/png/512/495/495668.png" alt="" width=35>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li>
                    <a class="dropdown-item" href="{{ url('actors')  }}">{{ __('Actors') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>