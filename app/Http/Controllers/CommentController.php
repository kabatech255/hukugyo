<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Job;
use App\User;
use Auth;

class CommentController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }


  public function store(Request $request,Job $job)
  {
    $comment = new Comment();
    $comment->body = $request->body;
    $comment->score = $request->score;
    $comment->user_id = Auth::user()->id;
    $comment->job_id = $job->id;
    $job->comments()->save($comment);
    return redirect()->action('JobController@show',$job);
  }

  public function destroy(Job $job, Comment $comment)
  {
    $comment->delete();
    return redirect()->back();
  }

}
