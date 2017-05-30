<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
  protected $fillable = [
  'user_id', 'follower_user_id',
];
  public function users()
  {
    return $this->belongsTo('App\User', 'follower_user_id');
  }
}
