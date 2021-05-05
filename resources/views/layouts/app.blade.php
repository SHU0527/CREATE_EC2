<?php $now_route = \Route::currentRouteName(); ?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	@if (strpos($now_route, 'admin') !== false)
		<style>body{background-color: tomato;}</style>
	@endif
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

					<!-- Branding Image -->
 @if (Auth::guard('user')->user() && strpos($now_route, 'admin') === false)
        {{--<a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}</a>--}}
    @elseif (Auth::guard('admin')->user() && strpos($now_route, 'admin') !== false)
        <a class="navbar-brand" href="{{ route('admin.home') }}">
            {{ config('app.name', 'Laravel') }}</a>
    @endif
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@if (is_null(Auth::guard('user')->user()) && strpos($now_route, 'admin') === false)
							<li><a href="{{ route('login') }}">Login</a></li>
							<li><a href="{{ route('register') }}">Register</a></li>
                            <li><a href="{{ route('login.scraping') }}">ログイン情報をスクレイピングする</a></li>

						@elseif (is_null(Auth::guard('admin')->user()) && strpos($now_route, 'admin') !== false)
							<li><a href="{{ route('admin.login') }}">Login</a></li>
						@endif
							<li class="dropdown">
							 @if (!empty(Auth::guard('user')->user()) && strpos($now_route, 'admin') === false)
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::guard('user')->user()->name }} <span class="caret"></span>
                                </a>
                                <a href="{{ route('profile.index') }}">ユーザーアカウント編集</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
										</form>
							@elseif (!empty(Auth::guard('admin')->user()) && strpos($now_route, 'admin') !== false)
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
								{{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
								</a>
					<ul class="dropdown-menu">
						<li>
                        <a href="{{ route('admin.members') }}">会員一覧</a><br>
						<a href="{{ route('admin.logout') }}"
						onclick="event.preventDefault();
						 document.getElementById('logout-form').submit();">
						Logout</a>
						<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
						</form>
							@endif
                           </li>
                                </ul>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
