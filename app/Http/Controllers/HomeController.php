<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('howToUse');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('home', [
          'archives'=>$request->archives,
          'current_jobs'=>$request->current_jobs
        ]);
    }

    public function howToUse(Request $request)
    {
        return view('howtouse', [
          'archives'=>$request->archives,
          'current_jobs'=>$request->current_jobs
        ]);
    }

    public function mypage(Request $request)
    {
        return view('mypage', [
          'archives'=>$request->archives,
          'current_jobs'=>$request->current_jobs
        ]);
    }

    protected function getArchives()
    {
      $archives = DB::select('select count(*) as count, DATE_FORMAT(created_at, "%Y年%c月") as ym from jobs group by DATE_FORMAT(created_at, "%Y年%c月") order by ym desc limit 12');

      return $archives;
    }
}
