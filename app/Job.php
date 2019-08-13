<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  protected $fillable = [
      'title', 'body', 'price', 'image'
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function comments()
  {
    return $this->hasMany('App\Comment');
  }

  public function scopeMonthly($query, $year, $month)
  {
      return $query->whereRaw("DATE_FORMAT(created_at, '%Y-%c') = '{$year}-{$month}'")->orderBy('created_at', 'desc')->paginate(12);
  }

}
