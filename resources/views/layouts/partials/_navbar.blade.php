<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Pagrindinis
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li>
                    <a class="dropdown-item" href="{{ url('projektai')  }}">{{ __('Projektai') }}</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ url('aktoriai')  }}">{{ __('Aktoriai') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>