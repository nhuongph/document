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
                <form class="form-signin" method="post" action="login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <span id="reauth-email" class="reauth-email"></span>
                    <input name="username" id="inputUsername" class="form-control" placeholder="Username" autofocus>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
                </form><!-- /form -->
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
