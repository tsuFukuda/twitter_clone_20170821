<?php

namespace App\Http\Controllers;

use App\Friendship;
use App\User;
use App\Tweet;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

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

    public function re_account(Request $request)
    {

//        $animal = Animal::where('name', $name)->firstOrFail();
//        $animal->update([
//            'name' => $request->input('name'),
//            'group' => $request->input('group'),
//        ]);

        $account = User::where('id', Auth::id())->firstOrFail();
        $account->update([
            'url_name' => $request->input('url_name'),
            'password' => $request->input('password'),
            'email' => $request->input('email'),
        ]);


//        $url_name = \Auth::user()->url_name;
//        $display_name  = \Auth::user()->display_name;
//        $user_address = \Auth::user()->email;
//        return view('settings.account', ['url_name' => $url_name, 'display_name' => $display_name, 'user_address' => $user_address]);
        return redirect('/account');
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


    public function id_profile($id)
    {
        $url_name = User::$url_name;
        dd($url_name);
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
//        dd($request);
//        $animal = Animal::where('name', $name)->firstOrFail();
//        $tweet = Tweet::where('body', $request)->firstOrFail();

//        $tweets = Tweet::where('body','like', "%$request%");
        $tweets = Tweet::whereIn('user_id', [Auth::id()])->orWhere('body','like', "%$request%")->orderBy('updated_at', 'desk')->get();
//        dd($tweets);
//        $tweets = DB::table('tweets')->where('body', 'like', "%{$request->query('search')}%")->get();
//        $tweet = Tweet::all();
//        dd($tweets);
        $display_name = \Auth::user()->display_name;
        $url_name = \Auth::user()->url_name;
        $user = Auth::user();
        return view('search', ['search' => $request->query('search'), 'tweets' => $tweets, 'display_name' => $display_name, 'url_name' => $url_name, 'user' => $user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user($id)
    {
        $url_name = DB::table('users')->where('id','=', "$id")->value('url_name');
        $display_name = DB::table('users')->where('id','=', "$id")->value('display_name');
//        tweets =
//        dd($url_name);
//        $tweets = Tweet::whereIn('user_id', [Auth::id()])->orWhere('body','like', "%$r%")->orderBy('updated_at', 'desk')->get();
        $tweets = DB::table('tweets')->where('user_id', '=', "$id")->get();
        $follower_num = DB::table('friendships')->where('follower_id', '=', "$id")->count();
        $followee_num = DB::table('friendships')->where('followee_id', '=', "$id")->count();
        $tweet_num = DB::table('tweets')->where('user_id', '=', "$id")->count();
        return view('user.index', ['url_name' => $url_name, 'display_name' => $display_name, 'tweets' => $tweets, 'follower_num' => $follower_num, 'followee_num' => $followee_num, 'tweet_num' => $tweet_num]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function following()
    {
        $display_name = Auth::user()->display_name;
        $user_id = Auth::user()->id;
        $tweet_num = DB::table('tweets')->where('user_id', '=', "$user_id")->count();
        $follower_num = DB::table('friendships')->where('follower_id', '=', "$user_id")->count();
        $followee_num = DB::table('friendships')->where('followee_id', '=', "$user_id")->count();
        $users = Auth::user()->following()->getRelated();
//        dd($users);
//        $friendships = Friendship::all();
//        dd($followers_num);
//        $users = User::all();
//        return view('user.following', ['users' => $users, 'followers' => $followers]);

        return view('user.following', ['display_name' => $display_name, 'tweet_num' => $tweet_num, 'follower_num' => $follower_num, 'followee_num' => $followee_num, 'users' => $users]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function followers()
    {
        return view('user.followers');
    }
}
