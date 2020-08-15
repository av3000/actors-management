    @include('layouts.partials._header')
    @include('layouts.partials._navbar')
    <div class="container-fluid">
        @yield('content')
    </div>
        @include('layouts.partials._footer')
        @include('layouts.partials._scripts')
    </body>
</html>