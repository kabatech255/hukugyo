<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@tora_rcr" />
        <meta property="og:url" content="https://www.gmrt.work" />
        <meta property="og:title" content="ポートフォリオ『副業サイト』" />
        <meta property="og:description" content="PHPフレームワーク「Laravel」学習のために作っているポートフォリオです" />
        <meta property="og:image" content="https://www.gmrt.work/img/header_001.jpg" />
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('page-title')</title>
        <link rel="icon" href="/img/icon.png">
        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <!-- font-family -->
        <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    </head>
    <body>
      <div id="app">
        <header>
          {{-- ナビゲーションバー --}}
          <nav class="header-nav flex-center">
            {{-- 1.ロゴ --}}
            <div class="header-logo">
              <a href="{{ url('/') }}" ><h1>副業サイト</h1></a>
            </div>

            {{-- 2.メニューバー --}}
            <div class="header-menubar">
              <button id="open_menu">
                <i class="fas fa-bars"></i>
              </button>
              <ul id="header_menu" class="list-none flex-center">
                <li class="menu-item"><a href="{{ url('/') }}">HOME</a></li>
                <li class="menu-item"><a href="{{ route('howtouse') }}">ご利用方法</a></li>
                <li class="menu-item"><a href="{{ route('jobs.index') }}">みんなの仕事</a></li>
                <li class="menu-item header-menu-parent" href="{{ url('/stories') }}">
                  <span>
                    体験談 <i class="list-toggler fas fa-caret-down"></i>
                  </span>
                  <ul class="header-menu-child list-none">
                    <li><a href="#">child1</a></li>
                    <li><a href="#">child2</a></li>
                    <li><a href="#">child3</a></li>
                  </ul>
                </li>

                @if(!Auth::check())
                <li class="menu-item"><a href="{{ route('login') }}">ログイン</a></li>
                @else
                <li class="header-menu-parent menu-item">
                  <span>
                    {{ Auth::user()->name }}さん <i class="list-toggler fas fa-caret-down"></i>
                  </span>
                  <ul class="header-menu-child list-none">
                    <li><a href="{{ route('mypage') }}">マイページ</a></li>
                    <li><a href="{{ url('/logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">ログアウト</a>
                                     <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                         @csrf
                                     </form>
                    </li>
                  </ul>
                </li>
                @endif
              </ul>
            </div>
          </nav>

          {{-- jumbotron --}}

          @if( strpos(Request::path(), 'jobs/') !== 0 && strpos(Request::path(), 'login') !== 0 && strpos(Request::path(), 'mypage') !== 0 )
          <div class="jumbotron rounded-0">
            {{-- 1.背景画像 --}}
            <div class="bgImage bg1"></div>
            <div class="bgImage bg2"></div>
            <div class="bgImage bg3"></div>
            <div class="bgImage bg4"></div>

            {{-- 2.アカウント登録ボタン --}}
            @if( !Auth::check() )
            <ul class="sns-links list-none flex-center">
                {{ csrf_field() }}
                <form method="POST" action="{{ route('login') }}">
                <li>
                  <a href="{{ route('register') }}" class="new-register">新規登録</a>
                </li>
                <li>
                  <a href="{{ url('/auth/twitter')}}" class="twitter"><i class="fab fa-twitter"></i> Twitterでログイン</a></li>
                <li>
                  <a href="{{ url('/auth/facebook')}}" class="facebook"><i class="fab fa-facebook-f"></i> Facebookでログイン</a>
                </li>
                <li>
                  <a href="{{ url('/auth/github')}}" class="github"><i class="fab fa-github"></i> GitHubでログイン</a>
                </li>
              </form>
            </ul>
            @endif
            {{-- 3.キャッチコピー --}}
            <div class="catch-copy-wrapper">
              <h1 class="catch-copy">人生は、一本道じゃない</h1>
            </div>
          </div>
          @endif
        </header>

        @extends('layouts.registerform')

        <div class="container page-body">
          <main>
            @yield('content')
          </main>
          @if( strpos(Request::path(), 'login') !== 0 )
          <aside>
            {{-- プロフィール --}}
            <div class="widget-profile">
              <div class="">
                <h3 class="widget-title">サイト管理者プロフィール</h3>
                <div class="widget-owner-thumb">
                  <img class="widget-owner-image" src="/img/owner.png" alt=""><br>
                  <span class="widget-owner-name">R.K</span>
                </div>
              </div>
              <div class="widget-owner-intro">
              元司法書士が31歳にしてPGを目指して半年。<br />
              前職でFileMakerを使った内部監査用の業務システムを開発し、プログラミングに興味を持ち始め、面白かったので2017年11月にPGへの転職を決意しました。<br>
              HTML/CSS/jQuery/PHP/MySQLを勉強中。<br>
              フレームワークはLaravelを学習中。
              </div>
              <div class="widget-owner-sns">
                <p>SNSアカウント</p>
                <a href="" title="リンクしません" data-toggle="tooltip" data-placement="top"><i class="fab fa-twitter"></i></a>
                <a href="" title="リンクしません" data-toggle="tooltip" data-placement="top"><i class="fab fa-facebook-f"></i></a>
                <a href="" title="リンクしません" data-toggle="tooltip" data-placement="top"><i class="fab fa-github"></i></a>
              </div>
            </div>
            {{-- 最新の記事 --}}
            <div class="widget-new-jobs">
              <h3 class="widget-title new-jobs">最近登録されたお仕事</h3>
              @forelse( $current_jobs as $job )
              <article class="new-job-wrapper">
                <div class="">
                   <img src="/img/uploaded/{{ $job->image }}" alt="">
                </div>
                <div class="new-job-link">
                  <a href="{{ route( 'jobs.show', $job->id ) }}">{{ $job->title }}</a>
                </div>
              </article>
              @empty
              <p>投稿されたお仕事はありません</p>
              @endforelse
            </div>

            <div class="widget-archives">
              <h3 class="widget-title">アーカイブ</h3>
              <ul class="widget-archives-list list-none">
                @forelse($archives as $archive)
                <li class="widget-archive-item">
                  <a href="{{ route('jobs.showFromArchives', ['year'=>$archive->year, 'month'=>$archive->month]) }}" class="widget-archive-link">
                    {{ $archive->ym }}  <span class="widget-archive-count">({{ $archive->count }})</span>
                  </a>
                </li>
                @empty
                投稿は1件もありません
                @endforelse
              </ul>

            </div>
            <!-- @yield('aside') -->
          </aside>
          @endif
        </div>
        <footer>
          {{-- 3.SNSボタン --}}
          <ul class="footer-snslinks list-none">
            <li><a href="#" title="リンクしません" data-toggle="tooltip" data-placement="top"><i class="fab fa-instagram"></i></a></li>
            <li><a href="#" title="リンクしません" data-toggle="tooltip" data-placement="top"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#" title="リンクしません" data-toggle="tooltip" data-placement="top"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#" title="リンクしません" data-toggle="tooltip" data-placement="top"><i class="fab fa-line"></i></a></li>
          </ul>
          <p class="text-center mt-3">&copy;kimura ryota  2019 All Rights Reserved.</p>
        </footer>
        @if( strpos(Request::path(), 'create') === false )
        <div id="transfer_create">
           <a href="{{ route('jobs.create') }}" class="btn">仕事を登録する</a>
        </div>
        @endif

        <!-- Scripts -->
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery-3.3.1.min.js"></script>
        <script src="/js/jquery.main.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
      </div>
    </body>
</html>
