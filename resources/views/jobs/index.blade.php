@extends('layouts.default')
@section('page-title', 'みんなの仕事')
@section('content')
  <h1 class="page-title"> - Jobs - </h1>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      {{ $jobs->links() }}
    </div>
  </div>
    <section class="jobs">
      @forelse($jobs as $job)
      <div class="job card huwa">
        <div class="img-wrapper">
          <img src="/img/uploaded/{{ $job->image }}" alt="" class="card-img-top p-0">
        </div>
        <a href="{{ route( 'jobs.show', $job ) }}"><h2 class="job-title">{{ $job->title }}</h2></a>
        <p class="job-price">{{ number_format( $job->price ) }}円</p>
        <hr class="m-0">
        <div class="flex-center auth-merge">
          <small><i class="fas fa-user user-icon"></i> {{ $job->user->name }}さん</small>
          @if(Auth::check())
          @if(Auth::user()->id === $job->user_id)
          <a href="{{ route('jobs.edit', ['job'=>$job]) }}" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i></a>
          <a href="#" class="del btn btn-danger btn-sm" data-id="{{ $job->id }}"><i class="fas fa-trash-alt"></i></a>
          <form class="" action="{{ route('jobs.destroy', ['job' => $job]) }}" method="post" id="del_{{ $job->id}}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
          </form>
          @endif
          @endif
        </div>
      </div>
      @empty
      <p>登録された仕事はありません。</p>
      @endforelse
    </section>
@endsection
