@extends('layouts.default')

@section('content')
<div class="job-create-form py-5">
  <h1 class="page-title text-center my-2">- Job Edit -</h1>
  <form action="{{ route('jobs.update', ['job' => $job]) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('put') }}
    {{ csrf_field() }}
    <div class="form-group w-75">
      <input class="form-control" type="text" name="title" value="{{ old('title', $job->title) }}" placeholder="タイトル" required autofocus>
      @if ($errors->has('title'))
          <p class="text-danger">{{ $errors->first('title') }}</p>
      @endif
    </div>

    <div class="form-group w-75">
        <textarea class="job-content-form" name="body" rows="10" placeholder="仕事内容" required>{{ old('body', $job->body) }}</textarea>
        @if ($errors->has('body'))
        <p class="text-danger">{{ $errors->first('body') }}</p>
        @endif
    </div>

    <div class="form-group w-75">
      <input class="form-control resize" type="text" name="price" value="{{ old('price', $job->price) }}" placeholder="1~10000までの数字" required autofocus> <span class="resized-form-next">円</span>
      @if ($errors->has('price'))
      <p class="text-danger">{{ $errors->first('price') }}</p>
      @endif
    </div>
    <div class="form-group w-75">
      <img id="edit_image" src="/img/uploaded/{{ $job->image }}" width="300" alt="">
      <p><input class="edit-checkbox" type="checkbox" name="del_image">この画像を削除して更新する</p>
      <div class="mt-3"><input type="file" name="image"></div>
      @if ($errors->has('image'))
      <p class="text-danger">{{ $errors->first('image') }}</p>
      @endif
    </div>

    <div class="text-center mt-5">
      <button type="submit" class="btn btn-register">
        修正する
      </button>
    </div>
  </form>
</div>
@endsection
