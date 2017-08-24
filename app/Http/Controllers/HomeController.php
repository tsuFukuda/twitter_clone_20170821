<?php

namespace App\Http\Controllers;

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
        $tweets = Tweet::all();
        $url_name = \Auth::user()->url_name;
        $display_name = \Auth::user()->display_name;
//        dd($display_name);
        $followers_num = DB::table('friendships')->count();
        return view('/home', ['tweets' => $tweets, 'url_name' => $url_name, 'display_name' => $display_name]);
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
        $tweets = Tweet::all();
        $user_id = \Auth::user();
        dd($user_id);
        return view('/home',  ['tweets' => $tweets]);

    }
}