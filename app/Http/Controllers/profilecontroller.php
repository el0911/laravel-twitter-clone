<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{

  public function show($username)
  {
      $user = User::where('username', $username)->firstOrFail();
      $followers_count =  $user->followers()->count();
      $tweets_count =  $user->tweets()->count();
      $following_count = $user->following()->count();
      $is_edit_profile = false;
      $is_following = false;
      if (Auth::check()) {
          $is_edit_profile = (Auth::id() == $user->id);
          $me = Auth::user();
          $following_count = $is_edit_profile ? $me->following()->count() : 0;
          $is_following = !$is_edit_profile && $me->isFollowing($user);
      }
      return view('profile', [
          'user' => $user,
          'tweets_count' => $tweets_count,
          'followers_count' => $followers_count,
          'is_edit_profile' => $is_edit_profile,
          'following_count' => $following_count,
          'is_following' => $is_following
          ]);
  }

  public function following($username)
  {
      $me = User::where('username', $username)->firstOrFail();
      $followers_count = $me->followers()->count();
      $following_count = $me->following()->count();
      $tweets_count =  $me->tweets()->count();
      $list = $me->following()->orderBy('username')->get();
      $is_edit_profile = true;
      $is_following = false;
      return view('following', [
          'user' => $me,
          'tweets_count' => $tweets_count,
          'followers_count' => $followers_count,
          'is_edit_profile' => $is_edit_profile,
          'following_count' => $following_count,
          'is_following' => $is_following,
          'list' => $list,
          ]);
  }

  public function following_auth()
  {
      $me = Auth::user();
      $followers_count = $me->followers()->count();
      $following_count = $me->following()->count();
      $tweets_count =  $me->tweets()->count();
      $list = $me->following()->orderBy('username')->get();
      $is_edit_profile = true;
      $is_following = false;
      return view('following', [
          'user' => $me,
          'tweets_count' => $tweets_count,
          'followers_count' => $followers_count,
          'is_edit_profile' => $is_edit_profile,
          'following_count' => $following_count,
          'is_following' => $is_following,
          'list' => $list,
          ]);
  }

  public function followers($username)
  {
      $user = User::where('username', $username)->firstOrFail();
      $followers_count =  $user->followers()->count();
      $following_count = $user->following()->count();
      $tweets_count =  $user->tweets()->count();
      $list = array();
      foreach($user->followers()->get() as $key => $follower)
      {
          $list[] = $follower->users()->get()->first();
      }
      $is_edit_profile = false;
      $is_following = false;
      if (Auth::check()) {
          $is_edit_profile = (Auth::id() == $user->id);
          $me = Auth::user();
          $following_count = $is_edit_profile ? $me->following()->count() : 0;
          $is_following = !$is_edit_profile && $me->isFollowing($user);
      }
      return view('followers', [
          'user' => $user,
          'tweets_count' => $tweets_count,
          'followers_count' => $followers_count,
          'is_edit_profile' => $is_edit_profile,
          'following_count' => $following_count,
          'is_following' => $is_following,
          'list' => $list,
          ]);
  }

  public function followers_auth()
  {
      $user = Auth::user();
      $followers_count =  $user->followers()->count();
      $following_count = $user->following()->count();
      $tweets_count =  $user->tweets()->count();
      $list = array();
      foreach($user->followers()->get() as $key => $follower)
      {
          $list[] = $follower->users()->get()->first();
      }

      $is_edit_profile = false;
      $is_following = false;
      if (Auth::check()) {
          $is_edit_profile = (Auth::id() == $user->id);
          $me = Auth::user();
          $following_count = $is_edit_profile ? $me->following()->count() : 0;
          $is_following = !$is_edit_profile && $me->isFollowing($user);
      }
      return view('followers', [
          'user' => $user,
          'tweets_count' => $tweets_count,
          'followers_count' => $followers_count,
          'is_edit_profile' => $is_edit_profile,
          'following_count' => $following_count,
          'is_following' => $is_following,
          'list' => $list,
          ]);
  }
}
