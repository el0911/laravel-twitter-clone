<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
     'username', 'name', 'email', 'password',
 ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


  public function following()
  {
    return $this->belongsToMany('App\User', 'followers', 'follower_user_id', 'user_id')->withTimestamps();
  }

  public function isFollowing(User $user)
  {
    return !is_null($this->following()->where('user_id', $user->id)->first());
  }

  public function followers()
  {
    return $this->belongsToMany('App\User', 'followers', 'user_id', 'follower_user_id')->withTimestamps();
  }

  public function tweets()
  {
    return $this->hasMany('App\Tweet', 'user_id', 'id');
  }

  public function timeline()
  {
    $following = $this->following()->with(['tweets' => function ($query) {
        $query->orderBy('created_at', 'desc');
    }])->get();
    // By default, the tweets will group by user.
    // [User1 => [Tweet1, Tweet2], User2 => [Tweet1]]
    //
    // The timeline needs the tweets without grouping.
    // Flatten the collection.
    $timeline = $following->flatMap(function ($values) {
        return $values->tweets;
    });
    // Sort descending by the creation date
    $sorted = $timeline->sortByDesc(function ($tweet) {
        return $tweet->created_at;
    });
    return $sorted->values()->all();
  }
}
