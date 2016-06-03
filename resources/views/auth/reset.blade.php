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
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1>Forgot Password</h1>
                <form class="form-signin" method="post" action="reset">
                    {!!Form::hidden('_token',csrf_token(),null)!!}
                    {!!Form::hidden('token',$token,null)!!}
                    <span id="reauth-email" class="reauth-email"></span>
                    <label>
                        Chage your password.
                    </label>
                    <input name="email" id="inputEmail" class="form-control" placeholder="Email" autofocus>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                    <input type="password" name="password_confirmation" id="inputPassword" class="form-control" placeholder="Re-Password">
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">OK</button>
                </form><!-- /form -->
                <a href="{!! url('login') !!}" class="forgot-password">
                    Login!
                </a>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
