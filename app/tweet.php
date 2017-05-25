<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class tweet extends Model
{

  protected $fillable = [
     'user_id', 'body',
 ];

 public function getCreatedAtAttribute($value) {
       return Carbon::createFromFormat('Y-m-d h:i:s', $value)->diffForHumans();
   }

}
