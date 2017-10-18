<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.app');
    }

    public function usersToFollow(Request $request){
        $notFollowingUsers =  Auth::user()->notFollowing(
            $request->has('actualShowingUsers')?
                json_decode(base64_decode($request["actualShowingUsers"])):
                [],
            5
        );
        $actualShowingUsers = base64_encode(json_encode($notFollowingUsers->pluck('id')->toArray()));

        $view = view('users-to-follow', get_defined_vars())->render();

        return response()->json(['html' => $view, 'actualShowingUsers' => $actualShowingUsers]);
    }


}
