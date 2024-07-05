<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '管理') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
</div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            <a class="navbar-brand" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                login
            </a>
            <a class="navbar-brand" href="#">
                @auth 
                {{ Auth::user()->name }} 
                @endauth
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
            <nav class="navbar-expand-md">
                <div class="container" style="display: flex;">
                 @auth
                    <div id="dashboard-links" style="display: flex;">
                        @if(Auth::user()->role === 0)
                            <a id="link-1" href="{{ route('all_stores_list') }}" style="margin-right: 10px;">全店舗</a>
                            <a id="link-2" href="{{ route('product_list') }}" style="margin-right: 10px;">商品</a>
                            <a id="link-3" href="{{ route('own_store_inventory') }}" style="margin-right: 10px;">自店舗</a>
                            <a id="link-4" href="{{ route('arrival_schedule') }}" style="margin-right: 10px;">入荷予定</a>
                            <a id="link-4" href="{{ route('employee_list') }}">社員</a>
                        @else
                            <a id="link-1" href="{{ route('inventory.general') }}" style="margin-right: 10px;">自店舗</a>
                            <a id="link-2" href="{{ route('arrival_list') }}">入荷予定</a>
                        @endif
                         </div>
                       @endauth
                    </div>
            </nav>
        </div>
    </nav>
    @yield('content')
</body>
</html>