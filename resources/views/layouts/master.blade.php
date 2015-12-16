<!DOCTYPE html>
<html lang="en" id="@yield('id')">

<head>
    <meta charset="UTF-8">
    <title>Pitimi - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>

<body>
    @if (Auth::check())
    <header class="container">
        <div>
            <h1>Pitimi
                <small>Public Talk Manager</small>
            </h1>
        </div>
        <nav class="navbar navbar-default">
            <ul class="nav navbar-nav">
                @foreach($menu as $item) @if($item['active'])
                <li class="active"><a href="{{ $item['url'] }}">{{ $item['text'] }}</a></li>
                @else
                <li><a href="{{ $item['url'] }}">{{ $item['text'] }}</a></li>
                @endif @endforeach
            </ul>
        </nav>
    </header>
    @endif
    <main class="container">
        @yield('content')
    </main>
</body>

</html>
