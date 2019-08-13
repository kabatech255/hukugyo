<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
      'user_id', 'user_id', 'job_id', 'body', 'score'
    ];

    public function user()
    {
      return $this->belongsTo('App\User');
    }
    public function job()
    {
      return $this->belongsTo('App\Job');
    }
}
