@extends('layouts.app')

@section('content')
<div class="container margin-top">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <img class="home-image" src="{{ asset('/img/steps/step4.png') }}" alt="">
                    ログインしました！<br>「マイページ」からタスクを開始しましょう！
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
