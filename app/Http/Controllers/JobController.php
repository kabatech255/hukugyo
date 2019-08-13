<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Job;
use App\Http\Requests\JobRequest;

// イメージアップロードのためのクラス
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class JobController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth')->except( ['index', 'show', 'showFromArchives'] );
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jobs = Job::latest()->paginate(12);
        return view('jobs.index', [
          'jobs' => $jobs,
          'archives' => $request->archives,
          'current_jobs'=>$request->current_jobs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('jobs.create', [
          'archives' => $request->archives,
          'current_jobs'=>$request->current_jobs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(JobRequest $request)
     {
       // 画像の処理
       $fileName = $this->imageUpload($request);
       $job = new Job();
       $job->user_id = Auth::user()->id;
       $job->title = $request->title;
       $job->body = $request->body;
       $job->price = $request->price;
       $job->image = $fileName;

       // $user = Auth::user();
       $job->save();

       return redirect('/jobs');
     }

         protected function imageUpload($request)
         {
           $user_dir = 'user_' . sprintf('%07d', Auth::user()->id);
           $path = public_path() . '/img/uploaded/' . $user_dir;
           if( !file_exists($path) ){
             $result = \File::makeDirectory($path);
           }

           if($request->hasFile('image')){
             $image = Input::file('image');
             $fileName = $user_dir . '/' . $image->getClientOriginalName();
             $path .= '/' . $image->getClientOriginalName();
             Image::make($image)->resize(300, 200)->save($path);
           }else{
             $fileName = 'noimage.jpg';
           }

           return $fileName;
         }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Job $job)
    {
        return view( 'jobs.show', [
          'job' => $job,
          'archives' => $request->archives,
          'current_jobs'=>$request->current_jobs,
        ]);
    }

    public function showFromArchives(Request $request, $year, $month)
    {

      // $jobs = Job::whereRaw("DATE_FORMAT(created_at, '%Y-%c') = '{$year}-{$month}'")->orderBy('created_at', 'desc')->paginate(12);
      $jobs = Job::monthly( $year, $month );
      return view('jobs.index', [
        'jobs'=>$jobs,
        'archives' => $request->archives,
        'current_jobs'=>$request->current_jobs,
      ]);

    }

    protected function findByYm($year, $month)
    {
        $jobs = DB::select("select * from jobs where DATE_FORMAT(created_at, '%Y-%c') = '{$year}-{$month}' order by created_at desc");

        return $jobs;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Job $job)
    {
        return view('jobs.edit', [
          'job' => $job,
          'archives' => $request->archives,
          'current_jobs'=>$request->current_jobs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, Job $job)
    {
      if( $request->hasFile('image') ){
        if($job->image !== 'noimage.jpg'){
          unlink(public_path() . '/img/uploaded/' . $job->image);
        }
        $fileName = $this->imageUpload($request);
      }elseif(isset($request->del_image)){
        if($job->image !== 'noimage.jpg'){
          unlink(public_path() . '/img/uploaded/' . $job->image);
        }
        $fileName = 'noimage.jpg';
       }else{
          $fileName = $job->image;
        }

      $job->title = $request->title;
      $job->body = $request->body;
      $job->price = $request->price;
      $job->image = $fileName;
      $job->save();

      return redirect('/jobs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
      if($job->image !== 'noimage.jpg'){
        unlink(public_path() . '/img/uploaded/' . $job->image);
      }
      $job->delete();
      return redirect('/jobs');

    }

    protected function getArchives()
    {
      $archives = DB::select('select count(*) as count, DATE_FORMAT(created_at, "%Y年%c月") as ym from jobs group by DATE_FORMAT(created_at, "%Y年%c月") order by ym desc limit 12');
      return $archives;
    }
}
