<?php

namespace App\Http\Controllers;

use App\Friendship;
use App\User;
use App\Tweet;
use Illuminate\Http\Request;
use DB;

class SampleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function account()
    {
        $url_name = \Auth::user()->url_name;
        $display_name  = \Auth::user()->display_name;
        $user_address = \Auth::user()->email;
        return view('settings.account', ['url_name' => $url_name, 'display_name' => $display_name, 'user_address' => $user_address]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $url_name = \Auth::user()->url_name;
        $display_name = \Auth::user()->display_name;
        $user_address = \Auth::user()->email;
        return view('settings.profile', ['url_name' => $url_name, 'display_name' => $display_name, 'user_address' => $user_address]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
//        dd($request);
//        $animal = Animal::where('name', $name)->firstOrFail();
//        $tweet = Tweet::where('body', $request)->firstOrFail();

        $tweets = DB::table('tweets')->where('body', 'like', "%{$request->query('search')}%")->get();
//        $tweet = Tweet::all();

//        dd($tweets);
        return view('search', ['search' => $request->query('search'), 'tweets' => $tweets]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user()
    {
        return view('user.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function following()
    {
        $friendships = Friendship::all();
        $followers_num = DB::table('friendships')->count();
        dd($followers_num);
//        $users = User::all();
//        return view('user.following', ['users' => $users, 'followers' => $followers]);

        return view('user.following');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function followers()
    {
        return view('user.followers');
    }
}
