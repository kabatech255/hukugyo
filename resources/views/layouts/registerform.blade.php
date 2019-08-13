<div id="mask" class="hidden">

</div>
<div id="modal" class="hidden py-5">
  <i id="close_form" class="fas fa-times-circle"></i>
  <h2 class="text-muted modal-label">新規登録フォーム</h2>
  <form action="{{ route('register') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group w-75">
      <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" value="{{ old('name') }}" placeholder="ニックネーム" required autofocus>
      @if ($errors->has('name'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('name') }}</strong>
          </span>
      @endif
    </div>

    <div class="form-group w-75">
      <input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" placeholder="xxx@example.com" required autofocus>
      @if ($errors->has('email'))
      <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('email') }}</strong>
      </span>
      @endif
    </div>

    <div class="form-group w-75">
      <input id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" value="" placeholder="パスワード（6文字以上）" required>
      @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
      @endif
    </div>

    <div class="form-group w-75">
      <input id="password-confirm" class="form-control" type="password" name="password_confirmation" placeholder="パスワード（確認用）" required>
    </div>

    <div class="text-center mt-5">
      <button type="submit" class="btn btn-register">
        この内容で登録する
      </button>
    </div>
  </form>
</div>
