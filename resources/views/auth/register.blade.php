@extends('layouts.header')

<title>Зареєструватись | Archimedes ELGS</title>
    </head>
    <body class="font-second background-primary">

        @include('layouts.navbar')

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center font-main text-white mt-5">Реєстрація</h1>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-3 col-md-6 col-xs-6 bg-white rounded mb-5">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-6 control-label mt-3">Логін</label>

                            <div class="col-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-6 control-label">E-Mail</label>

                            <div class="col-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('identifier') ? ' has-error' : '' }}">
                            <label for="identifier" class="col-md-6 control-label">Номер залікової книжки</label>

                            <div class="col-12">
                                <input id="identifier" type="text" class="form-control" name="identifier" value="{{ old('identifier') }}" required>

                                @if ($errors->has('identifier'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('identifier') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-6 control-label">Пароль</label>

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
                            <label for="password-confirm" class="col-md-6 control-label">Повторіть пароль</label>

                            <div class="col-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Зареєструватись
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>
