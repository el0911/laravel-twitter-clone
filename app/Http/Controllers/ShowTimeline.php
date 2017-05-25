<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ShowTimeline extends Controller
{
     public function show()
    {
        $user = Auth::user();
        return response()->json($user->timeline());
    }
}
