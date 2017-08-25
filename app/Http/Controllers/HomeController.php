<?php

namespace App\Http\Controllers;

use App\Friendship;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tweet;
use DB;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return mixed
     */
    public function index()
    {
//        初期読み込み
//        $tweets = Tweet::all();
//        $tweets = Tweet::where('user_id', Auth::id())->get();
        $tweets = Tweet::whereIn('user_id', [Auth::id(), Auth::user()->following()->pluck('id')])->orderBy('updated_at', 'desk')->get();
//        dd($tweets);
//        dd(Auth::id(), Auth::user()->following()->pluck('id'));
//        dd($tweets);
//        $tweets = Friendship::all()->follower_id;

//        dd(Friendship::find(1, 'follower_id'));
//        dd(Friendship::find(0, 'follower_id'));
//        $tweets = DB::table('tweets')->where('user_id', '=', '1')->get();
//        dd($tweets);
//        $tweets = DB::table('tweets')->where('user_id', '=', "\Auth::user()->user_id")->get();
//        dd($tweets);
        $user = Auth::user();

        $url_name = \Auth::user()->url_name;
//        $display_name = Tweet::find(2)->user->display_name;
        $display_name = \Auth::user()->url_name;
        $followers_num = DB::table('friendships')->count();
//        dd($followers_num);
        return view('/home', ['tweets' => $tweets, 'url_name' => $url_name, 'display_name' => $display_name, 'user' => $user]);
    }


    public function register_tweet_table(Request $request)
    {

//        dd(Auth::user());

//        $user = Auth::all();
//        dd("ここにいるよ");
//        dd($user);
//        dd($request->input('body'));
        Tweet::create([
            'user_id' => Auth::id(),
            'body' => $request->input('body'),
        ]);

//        投稿時に読み込み
        $user = Auth::user();
//        $tweets = Tweet::all();
        $tweets = Tweet::whereIn('user_id', [Auth::id(), Auth::user()->following()->pluck('id')])->orderBy('updated_at', 'desk')->get();
        $display_name = \Auth::user()->display_name;
//        $display_name = DB::table('users')->select('display_name')->where('user_id', DB::table('tweets')->select('user_id'));
//        dd($display_name);
        $url_name = \Auth::user()->url_name;
        return view('/home',  ['tweets' => $tweets, 'display_name' => $display_name, 'url_name' => $url_name, 'user' => $user]);

    }
}