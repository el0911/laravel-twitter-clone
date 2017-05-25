<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
//use Illuminate\Support\Facades\Auth;


class ShowTimelin extends Controller
{
  public function __invoke()
     {
         $user = Auth::user();
         return response()->json($user->timeline());
     }
}
