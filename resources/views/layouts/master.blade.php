    @include('layouts.partials._header')
    @include('layouts.partials._navbar')
    <div class="container mt-4">
        @yield('content')
    </div>
        @include('layouts.partials._footer')
        @include('layouts.partials._scripts')
    </body>
</html>