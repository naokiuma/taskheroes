@extends('layouts.app')
@section('content')

<div class="space"></div>

<div class="billboard">
    <div class="billboard-title">
        <h1>
            <span class="heading-primary--main">Task Heroes</span>
            <span class="heading-primary--sub">日々の生活、遊び、トレーニングをちょっと楽しく。</span>
        </h1>
    </div>

</div>

<section class="about-wrapper">
    <div class="about-description">
        <h2 class="section-heading">About</h2>
        <p><span>「TaskHeroes」</span>はやりたいこと、やるべきこと、、<br>
        あなたの日常の「task」を勇者の力に変換するサービスです。<br><br>
        taskの実施をすることで、<br>
        勇者のあなたも一緒に育ちます。
        <br>
        例えば・・・
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
        <span class="heading-primary--sub">タスクをこなして勇者を育てよう。</span>


    </div>


</section>

<section class="howto">
    <h2 class="section-heading">Howto</h2>
</section>

@endsection

    
   
