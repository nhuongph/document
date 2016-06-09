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
                <h1>Register</h1>
                <form class="form-signin" method="post" action="register" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <span id="reauth-email" class="reauth-email"></span>
                    <input name="username" id="inputUsername" class="form-control" placeholder="Username" autofocus>
                    <input name="email" id="inputEmail" class="form-control" placeholder="Email">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                    <input type="password" name="password_confirmation" id="inputPassword" class="form-control" placeholder="Re-Password">
                    <input type="file" name="avatar" class="inputAvartar" />
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Register</button>
                </form><!-- /form -->
                <a href="{!! url('login') !!}" class="forgot-password">
                    Login!
                </a>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
