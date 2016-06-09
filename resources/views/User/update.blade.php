<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>        
        <script src="{!! asset('js/jquery-1.11.3.min.js') !!}"></script>
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
                {!! Form::open(array('url' => 'update', 'files' => true, 'class'=>'form-signin')) !!}
                    {!! Form::hidden('id',$user->id) !!}
                    <div class="form-group">
                        {!! Form::label('username','Username:') !!}
                        {!! Form::text('username', $user->username, ['class' => 'form-control','placeholder'=>"Username"]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email','Email:') !!}
                        {!! Form::text('email', $user->email, ['class' => 'form-control','placeholder'=>"Email"]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password','Password:') !!}
                        {!! Form::password('password', ['class' => 'form-control','placeholder'=>"Password"]) !!}
                    </div>                
                    <div class="form-group">
                        {!! Form::label('password_confirmation','Re-Password:') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control','placeholder'=>"Re-Password"]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('avatar','Select your avatar:') !!}
                        {!! Form::file('avatar',['class'=>"btn btn-default btn-file form-control"]) !!}
                    </div>
                    <?php echo link_to('/login', $title = 'Cancel' ,$parameters = array('class' => 'btn btn-success'), $secure = null); ?>
                    {!! Form::submit('Update',['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}<!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
