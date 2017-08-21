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

<nav class="navbar navbar-toggleable-sm fixed-top navbar-guest">
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

        <a class="navbar-brand" href="{{ url('login') }}">Laratweet</a>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            {{--<ul class="navbar-nav mr-auto">--}}
            <ul class="navbar-nav ml-auto">
                <li class="active">
                    <a class="nav-link" href="{{ url('login') }}">
                        <span class="icon icon-login"></span> ログイン
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ url('register') }}">
                        <span class="icon icon-plus"></span> 登録
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container pt-4">
    <div class="row">
        <div class="offset-lg-2 col-lg-8">
            <section class="card mb-4">
                <div class="card-header" style="background-color: white">
                    <h1>登録</h1>
                </div>

                <div class="card-block">
                    <form method="POST" action="{{ url('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group row {{ $errors->has('url_name') ? ' has-danger' : '' }}">
                            <label for="url_name" class="col-4 col-form-label text-right">ユーザ名</label>
                            <div class="col-6">
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon2">&#64;</span>
                                    <input name="url_name" type="text" id="url_name"
                                           class="form-control form-control-danger"
                                           value="{{ old('url_name') }}" required autofocus>
                                </div>

                                @if ($errors->has('url_name'))
                                    <div class="form-control-feedback">
                                        <strong>{{ $errors->first('url_name') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label for="email" class="col-4 col-form-label text-right">メールアドレス</label>
                            <div class="col-6">
                                <input name="email" id="email" type="email" class="form-control form-control-danger"
                                       value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <div class="form-control-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label for="password" class="col-4 col-form-label text-right">パスワード</label>
                            <div class="col-6">
                                <input name="password" id="password" type="password"
                                       class="form-control form-control-danger" required>

                                @if ($errors->has('password'))
                                    <div class="form-control-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-4 col-form-label text-right">パスワード(確認)</label>
                            <div class="col-6">
                                <input name="password_confirmation" id="password-confirm" type="password"
                                       class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6 offset-4">
                                <button type="submit" class="btn btn-primary">
                                    登録
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
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
</body>
</html>
