<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.js') }}">
        <title>taskHeroes</title>
    </head>
    <body>
        <header class="header">
            <div class="header__logo-area">ヘッダーアイコン</div>

            <div class="header__manu-area">
            <ul class="header__nav">
                <li class="">マイページ</li>
                <li class="">タスク一覧</li>
                <li class="">タスク登録</li>
                <li class="">アイテム</li>
                <div id="taskform"></div>
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