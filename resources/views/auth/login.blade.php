@extends('layouts.header')

<title>Увійти | Archimedes ELGS</title>
    </head>
    <body class="font-second background-primary">

        @include('layouts.navbar')

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center font-main text-white mt-5">Вхід</h1>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-3 col-md-6 col-xs-6 bg-white rounded ml-xs-1 mr-xs-1">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-6 control-label mt-3">Електронна адреса</label>

                                    <div class="col-12">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Пароль</label>

                                    <div class="col-12">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запам'ятати мене
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary ">
                                            Увійти
                                        </button>

                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Забули пароль?
                                        </a>
                                    </div>
                                </div>
                </form>
            </div>
        </div>
    </body>
</html>
