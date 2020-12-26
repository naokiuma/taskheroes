@extends('layouts.app')
@section('content')

<div class="space"></div>

<div class="billboard">
    
    <img class="billboard-img1"src="../img/bottomup.png" alt="">
    <div class="billboard-title">
        <h1>
            <span class="heading-primary--main animate__animated animate__bounceInLeft">Task Heroes</span>
            <span class="heading-primary--sub">日々の生活、遊び、トレーニングをちょっと楽しく。</span>
        </h1>
        
    </div>

</div>

<section class="about-wrapper">
    <div class="about-description">
        <h2 class="section-heading">About</h2>
        <p><span class="hovermoveLeft underLine">「TaskHeroes」とは</span></p>
        <p>やりたいこと、やるべきこと、、<br>
        あなたの日常の「task」を勇者の力に変換するサービスです。<br><br>
        </p>

        <div class="about-examples radial-bg">
            <div class="about-example example1"><i class="fas fontawasome fa-walking fontawasome-margin"></i>
                たくさん散歩すると
                <span class="">体力<i class="fas fa-arrow-up fontawasome-arrow "></i></span>
                Up!
            </div> 
            <div class="about-example example2"><i class="fas fontawasome fa-book-reader fontawasome-margin"></i>
                興味のあることを学ぶと
                <span class="">知識<i class="fas fa-arrow-up fontawasome-arrow "></i></span>
                Up!
            </div>
            <div class="about-example example3"><i class="fas fontawasome fa-gamepad v"></i>
                好きなゲームに熱中すると
                <span class="">魔力<i class="fas fa-arrow-up fontawasome-arrow "></i></span>
                Up!
            </div>

            <div class="about-images">
                <img class="about-image1"src="../img/art.png" alt="">
                    <i class="fas fa-arrow-right fontawasome-margin fontawasome-arror-right"></i>
                <img class="about-image2"src="../img/fighter.png" alt="">
            </div>
        </div>
        <span class="heading-primary--sub">自分を育て、勇者も育てよう。</span>


    </div>


</section>

<section class="howto-wrapper">
    <div class="howto-description">
    <h2 class="section-heading">Howto</h2>
        <p><span class="hovermoveLeft underLine">使い方</span></p>
        <div class="howto-steps">
            <div class="howto-step">
                <h4>Step1<br>taskを登録</h4>
                <p>
                    勉強、筋トレ、家事、遊び。
                    毎日やることやチャレンジしたいことを登録しよう。
                    日課としても登録できます。
                </p>
                
            </div>
            <div class="howto-step">
                <h4>Step2<br>taskを実施</h4>
                <p>
                    実施したら完了！しよう。
                </p>
            </div>
            <div class="howto-step">
                <h4>Step3<br>経験値取得</h4>
                <p>
                    経験値を取得。難易度が高いと能力値が上がる可能性も上がる！
                </p>
            </div>
            <div class="howto-step">
                <h4>Step4<br>レベルアップ！</h4>
                <p>
                    経験値が貯まればレベルアップ。HPや能力がランダムで上がります。
                </p>
            </div>
            <div class="howto-step">
                <h4>Step5<br>アイテムゲット！</h4>
                <p>
                    一定のレベルや能力値に達しアイテムを取得。いろんな効果があります。</p>
            </div>

        </div>

    </div>

    

</section>



@endsection

    
   
