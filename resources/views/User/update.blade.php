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
                <img id="profile-img" class="profile-img-card" src="{!! asset($user['avatar']) !!}" />
                <p id="profile-name" class="profile-name-card"></p>
                <h1>Update User</h1>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-signin" method="post" action="/update" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $user['id'] }}">
                    <span id="reauth-email" class="reauth-email"></span>
                    <input name="username" value="{{ $user['username'] }}" id="inputUsername" class="form-control" placeholder="Username" autofocus>
                    <input name="email" value="{{ $user['email'] }}" id="inputEmail" class="form-control" placeholder="Email">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                    <input type="password" name="password_confirmation" id="inputPassword" class="form-control" placeholder="Re-Password">
                    <input type="file" name="avatar" class="inputAvartar" />
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Update</button>
                </form><!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
