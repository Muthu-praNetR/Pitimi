<!DOCTYPE html>
<html lang="en" id="@yield('id')">

<head>
    <meta charset="UTF-8">
    <title>Pitimi - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>

<body>
    @if (Auth::check())
    <div class="container">
        <nav>
            <ul>
            @foreach($menu as $item)
            <li><a href="{{ $item['url'] }}">{{ $item['text'] }}</a></li>
            @endforeach
            </ul>
        </nav>
    </div>
    @endif
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
