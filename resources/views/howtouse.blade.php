@extends('layouts.default')
@section('page-title', 'ご利用方法')
@section('content')

  <h1 class="page-title"> - How To Use - </h1>
  <ul class="list-none flex-center steps">
    <li class="step step1 p-3 huwa">
        <h2 class="content-label">STEP1: 新規登録</h2>
        <div class="content">
          <div class="step-image"><img src="/img/header_003.jpg" alt=""></div>
          <p>ニックネーム、メールアドレスを登録します。TwitterやFacebookのアカウントをお持ちの方は、ボタンひとつで手軽にご登録いただけます。
          </p>
        </div>
    </li>
    <li class="step step2 p-3 huwa">
        <h2 class="content-label">STEP2: お仕事登録</h2>
        <div class="content">
          <div class="step-image"><img src="/img/header_001.jpg" alt=""></div>
          <p>お仕事内容や金額を登録します。写真や文章など工夫して、みんなの目に留まればマッチングしやすいかもしれませんよ。</p>
        </div>
    </li>
    <li class="step step3 p-3 huwa">
        <h2 class="content-label">STEP3: お仕事閲覧</h2>
        <div class="content">
          <div class="step-image"><img src="/img/header_002.jpg" alt=""></div>
          <p>どのようなお仕事が登録されているか、閲覧もできます。<br>
            レビューを書いたり、気に入ったものがあれば頼んでみましょう。
          </p>
        </div>
    </li>
  </ul>
@endsection
