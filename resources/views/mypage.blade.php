@extends('layouts.default')
@section('page-title', 'マイページ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    {{Auth::User()->name}} さん、ようこそ！<br>
                </div>
            </div>
        </div>
    </div>
    <div class="scores">
        <div class="scoreItem">
            <div class="scoreTitle">
                総合評価
            </div>
            <div class="scoreBody">
                <div class="scoreText">
                    <span class="scoreNum">4.8</span>
                    <span class="scoreUnit">点</span>
                </div>
            </div>
        </div>
        <div class="scoreItem">
            <div class="scoreTitle">
                受託件数
            </div>
            <div class="scoreBody">
                <div class="scoreText">
                    <span class="scoreNum">13</span>
                    <span class="scoreUnit">件</span>
                </div>
            </div>
        </div>
        
    </div>
@endsection
