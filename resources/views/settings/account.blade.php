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
                    <a class="nav-link" href="#">
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

<div class="container pt-4">
    <div class="row">

        <div class="col-lg-3">
            <div class="card card-profile mb-4">
                <div class="card-header bg-danger"></div>
                <div class="card-block text-center">
                    <a href="#">
                        <img class="avatar card-profile-img" src="{{ asset('images/no-thumb.png') }}">
                    </a>

                    <div class="card-title my-2">
                        <a class="font-weight-bold text-inherit d-block" href="#">牧野</a>
                        <span class="text-muted">&#64;snicmakino</span>
                    </div>
                </div>
            </div>

            <div class="list-group mb-4">
                <a href="#" class="list-group-item list-group-item-action justify-content-between">
                    アカウント
                    <span class="icon icon-chevron-right"></span>
                </a>
            </div>

            <div class="list-group mb-4">
                <a href="#" class="list-group-item list-group-item-action justify-content-between">
                    プロフィール
                    <span class="icon icon-chevron-right"></span>
                </a>
            </div>

            <div class="card card-link-list mb-4">
                <div class="card-block">&copy; AsiaQuest Co., Ltd</div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header" style="background-color: #FFFFFF;">
                    <strong>アカウント</strong>
                </div>
                <div class="card-block">
                    <form method="POST" action="#">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group row {{ $errors->has('url_name') ? ' has-danger' : '' }}">
                            <label for="url_name" class="col-4 col-form-label">ユーザー名</label>
                            <div class="col-8">
                                <input name="url_name" type="text" maxlength="15" id="url_name" class="form-control"
                                       value="snicmakino">

                                @if ($errors->has('url_name'))
                                    <div class="form-control-feedback">
                                        <strong>{{ $errors->first('url_name') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label for="email" class="col-4 col-form-label">メールアドレス</label>
                            <div class="col-8">
                                <input name="email" type="email" id="email" class="form-control"
                                       value="makino@asia-quest.jp">

                                @if ($errors->has('email'))
                                    <div class="form-control-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label for="password" class="col-4 col-form-label">パスワード</label>
                            <div class="col-8">
                                <input name="password" type="password" id="password" class="form-control">

                                @if ($errors->has('password'))
                                    <div class="form-control-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-4 col-form-label">パスワード(確認)</label>
                            <div class="col-8">
                                <input name="password_confirmation" type="password" id="password_confirmation"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button type="submit" class="btn btn-success mt-4">保存する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="hidden-lg-up">
                <div class="card card-link-list mb-4">
                    <div class="card-block">&copy; AsiaQuest Co., Ltd</div>
                </div>
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
        $('a[href="' + location.href + '"]').addClass('active');
    });
</script>

</body>
</html>
