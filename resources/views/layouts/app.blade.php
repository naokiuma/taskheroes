<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" rel="stylesheet">
        <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.js') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Acme&family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet"> 
        <!--jquary-->
        <script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
        <title>taskHeroes</title>
    </head>
    <body>
        <header class="header">
            <div class="header__logo-area animate__animated animate__bounceInLeft">
            <a href="{{ route('top') }}">TaskHeroes</a>
            </div>

            <nav class="header__manu-area">
            <ul class="header__nav">
                
                @guest
                <!--<li class=""><a href="{{ route('alltasks') }}">みんなのタスク</a></li>-->
                <li class=""><a href="{{ route('login') }}">ログイン</a></li>
                <li class=""><a href="{{ route('register') }}">新規登録</a></li>
                @endguest
                @auth
                <!--<li class=""><a href="{{ route('alltasks') }}">みんなのタスク</a></li>-->
                <li class=""><a href="{{ route('user.mypage') }}">マイページ</a></li>
                
                <li class="">
                    <a class="" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                     >ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth

                
            </ul>
            <!--
            @if (Route::has('login'))
                <div class="top-right links">

                    @auth
                        <a href="{{ url('/') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            -->
        </nav>
        </header>
        @yield('content')
    </body>
    
    <script src="{{mix('js/app.js')}}"></script>

</html>