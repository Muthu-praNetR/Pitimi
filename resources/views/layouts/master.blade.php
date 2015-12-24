<!DOCTYPE html>
<html lang="en" id="@yield('id')">

<head>
    <meta charset="UTF-8">
    <title>{{ trans('messages.app_name') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>

<body>
@if (Auth::check())
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>
                        <i class="fa fa-cube"></i> {{ trans('messages.app_name') }}
                        <small>{{ trans('messages.app_description') }}</small>
                    </h1>
                </div>
                <div class="col-md-6">
                    <ul class="language-switcher">
                        <li><i class="fa fa-language"></i> Languages:</li>
                        @foreach($locales as $locale)
                            <li><a href="{{ Request::url() }}?lang={{ $locale->code }}">{{ $locale->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
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
                            {{ trans('messages.logout') }}
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
