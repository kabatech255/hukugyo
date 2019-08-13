@extends('layouts.default')
@section('page-title', 'みんなの仕事')
@section('content')
  <h1 class="page-title"> - {{ $job->title }} - </h1>
  <section class="p-3">
    <div class="job card selected">
      <div class="img-wrapper">
        <img src="/img/uploaded/{{ $job->image }}" alt="" class="card-img-top p-0">
        <p class="job-price show-page">{{ number_format( $job->price ) }}円</p>
      </div>
      <h2 class="job-title">{{ $job->title }}</h2>
      <p class="job-description">{!! nl2br(e($job->body)) !!}</p>
      <small>
        <i class="fas fa-user user-icon"></i> {{ $job->user->name }}さん
        <a href="#" class="btn new-comment font-weight-bold" title="コメントをする" data-toggle="tooltip" data-placement="top"><i class="fas fa-comment"></i></a>
      </small>
    </div>
  </section>
  <section class="comments">
    <h1 class="page-title"> - Comments - </h1>
    <div class="new-comment-wrapper">

    </div>
    @forelse($job->comments as $comment)
      <div class="comment flex-center">
          <div class="comment-user-box">
              <i class="fas fa-user user-icon"></i><br>
              <span>{{ $comment->user->name }}さん</span>
          </div>
          <div class="comment-content-box">
              <small class="post-time">{{ $comment->created_at }}</small>
              <p class="text-body">{!! nl2br(e($comment->body)) !!}</p>
              @if(Auth::check())
              @if( Auth::user()->id === $job->user_id )
                <a href="#" class="del" title="コメントを削除する" data-id="{{ $comment->id }}"><i class="fas fa-trash-alt"></i></a>
                <form class="" action="{{ route('comments.destroy', ['job' => $job, 'comment' => $comment]) }}" method="post" id="del_{{ $comment->id}}">
                  {{ csrf_field() }}
                  {{ method_field('delete') }}
                </form>
              @endif
              @endif
          </div>
      </div>
    @empty
    <p>コメントはありません</p>
    @endforelse
  </section>

    @extends('layouts.commentform')

@endsection
