@extends('layouts.default')

@section('content')
<div class="job-create-form py-5">
  <h1 class="page-title text-center my-2">- Job Create -</h1>
  <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group w-75">
      <input class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="タイトル" required autofocus>
      @if ($errors->has('title'))
          <p class="text-danger">{{ $errors->first('title') }}</p>
      @endif
    </div>

    <div class="form-group w-75">
        <textarea class="job-content-form" name="body" rows="10" placeholder="仕事内容" required>{{ old('body') }}</textarea>
        @if ($errors->has('body'))
        <p class="text-danger">{{ $errors->first('body') }}</p>
        @endif
    </div>

    <div class="form-group w-75">
      <input class="form-control resize" type="text" name="price" value="{{ old('price') }}" placeholder="1~10000までの数字" required autofocus> <span class="resized-form-next">円</span>
      @if ($errors->has('price'))
      <p class="text-danger">{{ $errors->first('price') }}</p>
      @endif
    </div>

    <div class="form-group w-75">
      <input type="file" name="image">
      @if ($errors->has('image'))
      <p class="text-danger">{{ $errors->first('image') }}</p>
      @endif
    </div>

    <div class="text-center mt-5">
      <button type="submit" class="btn btn-register">
        この内容で登録する
      </button>
    </div>
  </form>
</div>
@endsection
