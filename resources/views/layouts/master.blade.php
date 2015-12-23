<!DOCTYPE html>
<html lang="en" id="@yield('id')">

<head>
    <meta charset="UTF-8">
    <title>Pitimi - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>

<body>
@if (Auth::check())
    <header>
        <div class="container">
            <h1>
                <i class="fa fa-cube"></i> Pitimi
                <small>Public Talk Manager</small>
            </h1>
        </div>
        <nav class="navbar navbar-default">
            <div class="container">
                <ul class="nav navbar-nav">
                    @foreach($menu as $item)
                        @if($item['active'])
                            <li class="active">
                                <a href="{{ $item['url'] }}">
                                    <i class="fa fa-{{ $item['icon'] }}"></i>
                                    {{ $item['text'] }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $item['url'] }}">
                                    <i class="fa fa-{{ $item['icon'] }}"></i>
                                    {{ $item['text'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <p class="navbar-text">
                            <i class="fa fa-user"></i>
                            {{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}
                            ({{ Auth::user()->email }})
                        </p>
                    </li>
                    @if(session('congregation'))
                        <li class="dropdown">
                            <p class="navbar-text"><i
                                        class="fa fa-building-o"></i> {{ session('congregation')->name }}</p>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('logout') }}">
                            <i class="fa fa-sign-out"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
@endif
<main class="container">
    @yield('content')
</main>
<script src="{{ asset('js/vendors.js') }}"></script>
@yield('script')
</body>

</html>
