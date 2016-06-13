<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Money love - Manager you money</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Font Awesome CSS -->
        <link href="{{ asset('layouts/css/font-awesome.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset('layouts/css/animate.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset('layouts/css/style.css') }}" rel="stylesheet">

        <!-- NhuongPH CSS -->
        <link href="{{ asset('layouts/css/mycss.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href='{{ asset('layouts/css/font-Lobster.css') }}' rel='stylesheet' type='text/css'>


        <!-- Template js -->
        <script src="{{ asset('layouts/js/jquery-2.1.1.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('layouts/js/jquery.appear.js') }}"></script>
        <script src="{{ asset('layouts/js/jqBootstrapValidation.js') }}"></script>
        <script src="{{ asset('layouts/js/modernizr.custom.js') }}"></script>
        <script src="{{ asset('layouts/js/script.js') }}"></script>

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <!-- Start Logo Section -->
        <section id="logo-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo text-center">
                            <h1>Money Lover</h1>
                            <span>Manager You Money</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo-right container">
                <?php if (Auth::check()) { ?>
                    {{ trans('home.welcome',['name' => Auth::user()->username]) }} | <a href="{!! url('welcome/vi') !!}">Việt Nam</a> &nbsp;<a href="{!! url('welcome/en') !!}">English</a> | <a href="{!! url('logout') !!}">Logout</a>
                <?php } ?>
            </div>
        </section>
        <!-- End Logo Section -->


        <!-- Start Main Body Section -->
        <div class="mainbody-section ">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 text-center">

                        <div class="menu-item light-red">
                            <a href="{!! url('home') !!}" data-toggle="modal">
                                <i class="fa fa-user"></i>
                                <p>Home</p>
                            </a>
                        </div>

                        <div class="menu-item green">
                            <a href="{!! url('wallet') !!}" data-toggle="modal">
                                <i class="fa fa fa-money"></i>
                                <p>All Wallet</p>
                            </a>
                        </div>

                        <div class="menu-item color responsive">
                            <a href="{!! url('category') !!}" data-toggle="modal">
                                <i class="glyphicon glyphicon-th-list"></i>
                                <p>All Categories</p>
                            </a>
                        </div>

                        <div class="menu-item light-red">
                            <a href="{!! url('transactions') !!}" data-toggle="modal">
                                <i class="fa fa-shopping-cart"></i>
                                <p>All Transaction money</p>
                            </a>
                        </div>

                    </div>

                    <div class="col-md-8 bg-white padding-top-bot col-md-offset-1">
                        <p class="text-center"><img id="profile-img" class="profile-img-card img-circle" src="{!! asset(Auth::user()->avatar) !!}" />
                        </p>
                        <h1 class="text-center">Register User</h1>
                        <div class="col-md-8 col-md-offset-2">
                            <!-- Start Carousel Section -->
                            <div class="card card-container">

                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if (Session::has('message'))
                                <div class="alert alert-success">
                                    <ul>
                                        <li>{!! session('message') !!}</li>
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
                                <?php echo link_to('/login', $title = 'Cancel', $parameters = array('class' => 'btn btn-success'), $secure = null); ?>
                                {!! Form::submit('Update',['class' => 'btn btn-success']) !!}
                                {!! Form::close() !!}<!-- /form -->
                            </div><!-- /card-container -->
                            <!-- Start Carousel Section -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Main Body Section -->
</body>

</html>