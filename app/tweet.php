<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tweet extends Model
{
	protected $fillable = [
	 'user_id', 'body',
	];

	public function getCreatedAtAttribute($value)
	{
	   return Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
	}

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
