<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Job;
use DB;
class ArchiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      // アーカイブのデータ
        $archives = $this->getArchives();
        foreach($archives as $archive){
          // 月の数字が始まる位置
          $start_point = 5;
          // 年月の中で'月'という文字は、どこの文字位置に来るか(1ケタ月なら6)
          $month_point = mb_strpos($archive->ym, '月');
          // $month_pointが6(1ケタ月)なら1, そうでない(2ケタ月)なら2
          $month_length = $month_point === 6 ? 1 : 2 ;
          // 年(4ケタ)を切り取る
          $archive->year = mb_substr($archive->ym, 0, 4);
          // $end_point文字分切り取る = 月の数字get
          $archive->month = mb_substr($archive->ym, $start_point, $month_length);
        }

      // 最新のお仕事
        $current_jobs = $this->getCurrentJobs();
        $request->merge(['archives' => $archives, 'current_jobs'=>$current_jobs]);

        return $next($request);
    }

    protected function getArchives()
    {
      $archives = DB::select('select count(*) as count, DATE_FORMAT(created_at, "%Y年%c月") as ym from jobs group by DATE_FORMAT(created_at, "%Y年%c月") order by ym desc limit 12');

      return $archives;
    }

    protected function getCurrentJobs()
    {
      $current_jobs = Job::latest()->limit(5)->get();
      return $current_jobs;
    }
}
