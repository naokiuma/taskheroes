@extends('layouts.app')
@section('content')

<div class="space"></div>




<section class="billboard">
    <img class="billboard-img1"src="{{ asset('/img/heroofhero.gif') }}" alt="">
    <!--<p class="billboard-text1">タスクをやって強くなる。</p>-->
    <!--<p class="billboard-text2"></p>-->
    <i class="fas fa-arrow-up billboard-arrow1 "></i>
    <i class="fas fa-arrow-up billboard-arrow2"></i>
    <i class="fas fa-arrow-up billboard-arrow3"></i>
    <div class="billboard-title">
        <h1>
            <span class="heading-primary--main animate__animated animate__bounce">Task Heroes</span>
            <span class="heading-primary--sub">タスクをやって強くなる。</span>
        </h1>
    </div>
</section>
<!--
<section class="news-area">
    <div class="news-inner">
        <div class="news">
            <span><time>2021/04/21</time></span>
            <h3 class="title">みんなのタスクを追加しました。</h3>
            <span class=text>全ユーザーが登録しているタスクを見れるようになりました。自身のモチベーションにつなげましょう！</span>

        </div>
    </div>
</section>
-->

<section class="about-wrapper">
    <div class="about-description">
        <h2 class="section-heading">About</h2>
        <p><span class="hovermoveLeft underLine">「TaskHeroes」とは</span></p>
        <p class="sp-center">やりたいこと、やるべきこと、、<br>
        あなたの日常の「task」を実施するとともに勇者が育つ。<br>
        日々の生活、遊びやトレーニングをちょっと楽しみながら、タスク管理を促進するサービスです。<br>
        <br>
        </p>

        <div class="about-examples radial-bg">
            <div class="about-example example1"><i class="fas fontawasome fa-walking fontawasome-margin"></i>
                たくさん散歩すると<br class="sp-br">
                <span class="">体力<i class="fas fa-arrow-up fontawasome-arrow "></i></span>
                Up!
            </div> 
            <div class="about-example example2"><i class="fas fontawasome fa-book-reader fontawasome-margin"></i>
                興味のあることを学ぶと<br class="sp-br">
                <span class="">知識<i class="fas fa-arrow-up fontawasome-arrow "></i></span>
                Up!
            </div>
            <div class="about-example example3"><i class="fas fontawasome fa-gamepad v"></i>
                好きなゲームに熱中すると<br class="sp-br">
                <span class="">魔力<i class="fas fa-arrow-up fontawasome-arrow "></i></span>
                Up!
            </div>

            <div class="about-images">
            
                <img class="about-image1"src="{{ asset('/img/art.png') }}" alt="">
                    <i class="fas fa-arrow-right fontawasome-margin fontawasome-arror-right"></i>
                <img class="about-image2"src="{{ asset('/img/fighter.png') }}" alt="">
            </div>
        </div>
        <p>自分を育て、勇者も育てよう。</p>
    </div>


</section>

<section class="howto-wrapper">
    <div class="howto-description">
    <h2 class="section-heading">Howto</h2>
        <p><span class="hovermoveLeft underLine">使い方</span></p>
        <div class="howto-steps">
            <div class="howto-step">
                <div class="step-textgroup">
                    <h4>Step1<br>taskを登録</h4>
                    <p>
                        勉強、筋トレ、家事、遊び。
                        毎日やることやチャレンジしたいことを登録しよう。
                    </p>
                </div>
                <img src="{{ asset('/img/steps/step1.png') }}" alt="">
            </div>
            <div class="howto-step">
                <div class="step-textgroup">
                    <h4>Step2<br>taskを実施</h4>
                    <p>
                        Let's Do it!
                    </p>
                </div>
                <img src="{{ asset('/img/steps/step2.png') }}" alt="">
            </div>
            <div class="howto-step">
                <div class="step-textgroup">
                    <h4>Step3<br>能力値と経験値を取得</h4>
                    <p>
                        1タスクで経験値1を取得。難易度分だけパラメータもアップします。
                    </p>
                </div>
                <img src="{{ asset('/img/steps/step3.png') }}" alt="">
            </div>
            <div class="howto-step">
                <div class="step-textgroup">
                    <h4>Step4<br>レベルアップ！</h4>
                    <p>
                        経験値が貯まればレベルアップ。HPや能力がランダムで上がります。
                    </p>
                </div>
                <img src="{{ asset('/img/steps/step4.png') }}" alt="">
            </div>
            <div class="howto-step">
                <div class="step-textgroup">
                    <h4>Step5<br>アイテムゲット！</h4>
                    <p>
                        一定のレベルや能力値に達しアイテムを取得。いろんな効果があります。
                    </p>
                </div>
                <img src="{{ asset('/img/steps/step5.png') }}" alt="">
            </div>
        </div>
    </div>
</section>
@guest
<div class="top--another-link">
    <div class="top--another-link-inner">
    <a href="{{ route('register') }}">早速登録する</a>

    </div>
</div>
@endguest

<footer class="footer">
    <p>Copyright © 2020 Task heroes. All Rights Reserved.</p>
</footer>

@endsection

    
   
