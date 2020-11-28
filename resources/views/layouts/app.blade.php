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
        
        <title>taskHeroes</title>
    </head>
    <body>
        <header class="header">
            <div class="header__logo-area">taskHeroes</div>

            <div class="header__manu-area">
            <ul class="header__nav">
                
                @guest
                <li class=""><a href="{{ route('login') }}">ログイン</a></li>
                <li class=""><a href="{{ route('register') }}">新規登録</a></li>
                @endguest
                @auth
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
                <li class="">アイテム</li>
                <div id="taskform"></div>
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
            </div>
        </header>
        @yield('content')

        <footer>
            <p>フッター</p>
        </footer>
    </body>

    <!--これも読み込む必要がある-->
    <script src="{{mix('js/app.js')}}"></script>

</html>