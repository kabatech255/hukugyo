@extends('layouts.default')

@section('content')

<div class="container">
            <div class="card">
                <div class="card-header font-weight-bold" style="font-size: 20px;">ログイン</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        ログイン状態を保持
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-bg btn-login">
                                    ログイン
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        パスワードを忘れた場合
                                    </a>
                                @endif
                            </div>
                        </div>
                        <ul class="sns-links for-login list-none flex-center">
                            <li>
                              <a href="{{ route('register') }}" class="btn new-register bg-dark">新規アカウント作成</a>
                            </li>
                            <li>
                              <a href="{{ url('/auth/twitter')}}" class="twitter"><i class="fab fa-twitter"></i> Twitter</a></li>
                            <li>
                              <a href="{{ url('/auth/facebook')}}" class="facebook"><i class="fab fa-facebook-f"></i> Facebook</a>
                            </li>
                            <li>
                              <a href="{{ url('/auth/github')}}" class="github"><i class="fab fa-github"></i> GitHub</a>
                            </li>
                        </ul>
                      </div>
                    </form>
                </div>
    </div>
</div>
@endsection
