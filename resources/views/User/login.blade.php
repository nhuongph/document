<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="{!! asset('bootstrap/css/bootstrap.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('css/default.css') !!}" rel="stylesheet" type="text/css">
        <script src="{!! asset('bootstrap/js/bootstrap.js') !!}"></script>

    </head>
    <body>
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="{!! asset('images/avatar_2x.png') !!}" />
                <p id="profile-name" class="profile-name-card"></p>
                <h1>Login</h1>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(array('url' => '/login','class'=>'form-signin')) !!}
                    <div class="form-group">
                        {!! Form::label('username','Username:') !!}
                        {!! Form::text('username', null, ['class' => 'form-control','placeholder'=>"Username"]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password','Password:') !!}
                        {!! Form::password('password', null, ['class' => 'form-control','placeholder'=>"PassWord"]) !!}
                    </div>
                    {!! Form::submit('Sign in',['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}<!-- /form -->
                <a href="{!! url('password/email') !!}" class="forgot-password">
                    Forgot the password?
                </a>
                <br>
                <a href="{!! url('register') !!}" class="forgot-password">
                    Register new member!
                </a>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
