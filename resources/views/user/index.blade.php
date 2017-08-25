<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <!-- Entypo CSS -->
    <link href="{{ asset('css/entypo.css') }}" rel="stylesheet">

    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>
<body class="application">

<nav class="navbar navbar-toggleable-sm fixed-top navbar-inverse bg-danger">
    <div class="container">
        <button
                class="navbar-toggler navbar-toggler-right hidden-md-up"
                type="button"
                data-toggle="collapse"
                data-target="#navbarResponsive"
                aria-controls="navbarResponsive"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand hidden-md-up" href="{{ url('home') }}">Laratweet</a>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mr-auto">
                <li>
                    <a class="nav-link" href="{{ url('home') }}">
                        <span class="icon icon-home"></span> ホーム
                    </a>
                </li>
                <li class="dropdown-divider"></li>
                <li class="hidden-md-up">
                    <a class="nav-link" href="{{ url('user') }}">
                        <span class="icon icon-cog"></span> 設定
                    </a>
                </li>
                <li class="hidden-md-up">
                    <a class="nav-link" href="{{ url('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <span class="icon icon-log-out"></span> ログアウト
                    </a>

                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>

            <form action="#" class="form-inline float-right hidden-sm-down">
                <span {{ $errors->has('search') ? 'has-danger' : '' }}>
                    <input name="search" type="text" class="form-control form-search" placeholder="Search">
                </span>
            </form>

            <ul class="nav navbar-nav hidden-sm-down">
                <li class="nav-item nav-account dropdown">
                    <a class="nav-link" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <img class="rounded-circle" src="{{ asset('images/no-thumb.png') }}">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#">
                            <span class="icon icon-cog"></span> 設定
                        </a>
                        <a class="dropdown-item" href="{{ url('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <span class="icon icon-log-out"></span> ログアウト
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="profile-header" style="background-image: url({{ asset('images/iceland.jpg') }})">
    <div class="container">
        <div class="container-inner">
            <img class="rounded-circle media-object" src="{{ asset('images/no-thumb.png') }}">
            <h3 class="profile-header-user">{{ $display_name }}</h3>
            <p class="profile-header-bio">{{ $url_name }}（JavaとかDBとかAWSとか） 空前絶後のKotlinブーム中</p>
        </div>
    </div>

    <nav class="profile-header-nav" id="profile-header">
        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    ツイート
                    <strong class="d-block">{{ $tweet_num }}</strong>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    フォロー
                    <strong class="d-block">{{ $follower_num }}</strong>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    フォロワー
                    <strong class="d-block">{{ $followee_num }}</strong>
                </a>
            </li>
        </ul>
    </nav>
</div>

<div class="container pt-4">
    <div class="row">
        <div class="col-lg-3">
            <div class="card mb-4">
                <div class="card-block">
                    <h6 class="card-title">フォロー/解除</h6>
                    <form action="#" method="POST">
                        {{ csrf_field() }}

                        <button type="submit" class="btn btn-outline-danger btn-md following" style="width: 7rem;">
                            <span>フォロー中</span>
                            <span>解除</span>
                        </button>
                    </form>

                    {{--<form action="#" method="POST">--}}
                    {{--{{ csrf_field() }}--}}

                    {{--<button type="submit" class="btn btn-outline-primary btn-md">フォローする</button>--}}
                    {{--</form>--}}
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <ul class="list-group media-list-stream mb-4">


                {{--時間の差分計算--}}
                <?php
                function format_time($timestamp)
                {
                    if (floor($timestamp / (60 * 60 * 24)) > 0) {
                        echo floor($timestamp / (60 * 60 * 24)) . "日";
                    } else if (floor($timestamp / (60 * 60)) > 0) {
                        echo floor($timestamp / (60 * 60)) . "h";
                    } else if (floor($timestamp / 60) > 0) {
                        echo floor($timestamp / 60) . "m";
                    } else {
                        echo floor($timestamp) . "s";
                    }
                }
                ?>

                @foreach($tweets as $tweet)
                    <li class="media list-group-item p-4">
                        <article class="d-flex w-100">
                            <a class="font-weight-bold text-inherit d-block" href="/profile">
                                <img class="media-object d-flex align-self-start mr-3"
                                     src="{{ asset('images/no-thumb.png') }}">
                            </a>
                            <div class="media-body">
                                <div class="mb-2">
                                    <a class="text-inherit" href="#">
                                        <strong>{{ $display_name }}</strong>
                                        <span class="text-muted">&#64;{{ $url_name }}</span>
                                    </a>
                                    -
                                    <time class="small text-muted">{{ format_time(strtotime(date('Y-m-d H:i:s'))-strtotime($tweet->updated_at)) }}</time>
                                </div>

                                <p>
                                    {{ $tweet->body }}
                                </p>
                            </div>
                        </article>
                    </li>
                @endforeach


                {{--<li class="media list-group-item p-4">--}}
                {{--<article class="d-flex w-100">--}}
                {{--<a class="font-weight-bold text-inherit d-block" href="#">--}}
                {{--<img class="media-object d-flex align-self-start mr-3"--}}
                {{--src="{{ asset('images/no-thumb.png') }}">--}}
                {{--</a>--}}
                {{--<div class="media-body">--}}
                {{--<div class="mb-2">--}}
                {{--<a class="text-inherit" href="#">--}}
                {{--<strong>牧野</strong>--}}
                {{--<span class="text-muted">&#64;snicmakino</span>--}}
                {{--</a>--}}
                {{-----}}
                {{--<time class="small text-muted">6時間</time>--}}
                {{--</div>--}}

                {{--<p>--}}
                {{--rust面白そうだなー--}}
                {{--でも、やりたい事が待ち行列になってる--}}
                {{--</p>--}}
                {{--</div>--}}
                {{--</article>--}}
                {{--</li>--}}
                {{--<li class="media list-group-item p-4">--}}
                {{--<article class="d-flex w-100">--}}
                {{--<a class="font-weight-bold text-inherit d-block" href="#">--}}
                {{--<img class="media-object d-flex align-self-start mr-3"--}}
                {{--src="{{ asset('images/no-thumb.png') }}">--}}
                {{--</a>--}}
                {{--<div class="media-body">--}}
                {{--<div class="mb-2">--}}
                {{--<a class="text-inherit" href="#">--}}
                {{--<strong>牧野</strong>--}}
                {{--<span class="text-muted">&#64;snicmakino</span>--}}
                {{--</a>--}}
                {{-----}}
                {{--<time class="small text-muted">8月15日</time>--}}
                {{--</div>--}}

                {{--<p>--}}
                {{--サマーインターンの講師してるんだけど、学生は分からない問題を一つずつ試して、トライアンドエラーをしながら前に進んでいる。--}}
                {{--そんな姿を見ながら、エンジニアって何年経ってもこの頃と変わらない気持ちと姿勢で、問題に向き合える良い仕事だなと感じた。--}}
                {{--</p>--}}
                {{--</div>--}}
                {{--</article>--}}
                {{--</li>--}}
            </ul>
        </div>

        <div class="col-lg-3">
            <div class="card card-link-list mb-4">
                <div class="card-block">&copy; AsiaQuest Co., Ltd</div>
            </div>
        </div>

    </div>
</div>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>

<script>
    $(function () {
        $('nav#profile-header a[href="' + location.href + '"]').parent().addClass('active');
    });
</script>

</body>
</html>
