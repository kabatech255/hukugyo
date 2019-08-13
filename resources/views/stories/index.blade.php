@extends('layouts.default')
@section('page-title', '体験談')
@section('content')
<div class="container top-container">
  <h1 class="page-title"> - Stories - </h1>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      {{ $stories->links() }}
    </div>
  </div>
    <section class="jobs">
      @forelse($stories as $story)
      <div class="job card">
        <div class="img-wrapper">
          <img src="/img/uploaded/{{ $story->image }}" alt="" class="card-img-top p-0">
        </div>
        <a href="{{ route( 'stories.show', $story ) }}"><h2 class="job-title">{{ $story->title }}</h2></a>
        <p class="job-description">{!! nl2br(e($story->body)) !!}</p>
        <hr class="m-0">
        <div class="flex-center auth-merge">
          <small><i class="fas fa-user user-icon"></i> {{ $story->user->name }}さん</small>
          @if(Auth::check())
          @if(Auth::user()->id === $story->user_id)
          <a href="{{ route('stories.edit', ['story'=>$story]) }}" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i></a>
          <a href="#" class="del btn btn-danger btn-sm" data-id="{{ $story->id }}"><i class="fas fa-trash-alt"></i></a>
          <form class="" action="{{ route('stories.destroy', ['story' => $story]) }}" method="post" id="del_{{ $story->id}}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
          </form>
          @endif
          @endif
        </div>
      </div>
      @empty
      <p>登録された体験談はありません。</p>
      @endforelse
    </section>

</div>
@endsection
