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
                                <p>{{ trans('money_lover.home') }}</p>
                            </a>
                        </div>

                        <div class="menu-item color responsive">
                            <a href="{!! url('category') !!}" data-toggle="modal">
                                <i class="glyphicon glyphicon-th-list"></i>
                                <p>{{ trans('money_lover.cate_all') }}</p>
                            </a>
                        </div>

                    </div>

                    <div class="col-md-9 bg-white padding-top-bot col-md-offset-0">
                        <h1 class="text-center">{{ trans('money_lover.cate_new') }}</h1>
                        <div class="col-md-10 col-md-offset-1 padding-top-bot">
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
                            {!! Form::open(array('url' => 'addcategory', 'files' => true, 'class'=>'form-signin')) !!}
                            <div class="form-group">
                                {!! Form::label('name',Lang::get('money_lover.cate_name').':') !!}
                                {!! Form::text('name',null, array('class'=>'form-control','placeholder'=>Lang::get('money_lover.cate_name'))) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('note',Lang::get('money_lover.note').':') !!}
                                {!! Form::textarea('note',null, array('class'=>'form-control','placeholder'=>Lang::get('money_lover.note').'...')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('image',Lang::get('money_lover.cate_image_1')) !!}
                                {!! Form::file('image',['class'=>"btn btn-default btn-file form-control"]) !!}
                                <p class="help-block">{{ trans('money_lover.cate_image_2') }}</p>
                            </div>
                            {!! Form::submit(Lang::get('money_lover.cate_new'),['class' => 'btn btn-success']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Main Body Section -->
</body>

</html>