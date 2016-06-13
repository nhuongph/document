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
        <div class="mainbody-section">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 text-center">

                        <div class="menu-item light-red">
                            <a href="{!! url('home') !!}" data-toggle="modal">
                                <i class="fa fa-user"></i>
                                <p>{{ trans('money_lover.wallet_home') }}</p>
                            </a>
                        </div>

                        <div class="menu-item green">
                            <a href="{!! url('wallet') !!}" data-toggle="modal">
                                <i class="fa fa fa-money"></i>
                                <p>{{ trans('money_lover.wallet_all') }}</p>
                            </a>
                        </div>

                        <div class="menu-item blue">
                            <a href="{!! url('addwallet') !!}" data-toggle="modal">
                                <i class="glyphicon glyphicon-star-empty"></i>
                                <p>{{ trans('money_lover.wallet_new') }}</p>
                            </a>
                        </div>

                    </div>

                    <div class="col-md-9 bg-white padding-top-bot col-md-offset-0">

                        <h1 class="text-center">{{ trans('money_lover.wallet_trans') }}</h1>
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
                        <div class="wallet col-md-12">
                            <h3>{{ trans('money_lover.wallet_from') }}</h3>
                            <table class="table table-striped text-left padding-top-bot">
                                <tr>
                                    <th>{{ trans('money_lover.wallet_avatar2') }}</th>
                                    <th>{{ trans('money_lover.wallet_name') }}</th>
                                    <th>{{ trans('money_lover.wallet_money') }}({!! $wallet->type_money !!})</th>
                                    <th>{{ trans('money_lover.wallet_note') }}</th>
                                </tr>
                                <tr>
                                    <td><img src="{!! asset($wallet->image) !!}" /></td>
                                    <td>{!! $wallet->name !!}</td>
                                    <td>{!! $wallet->money !!}</td>
                                    <td>{!! $wallet->note !!}</td>                                    
                                </tr>
                            </table>
                        </div>
                        <div class="chose_wallet"> 
                            <table class="table table-hover">
                                <hr>
                                <div class="col-md-8 col-md-offset-0">
                                    <h3>{{ trans('money_lover.wallet_to') }}</h3>
                                    {!! Form::open(array('url' => 'transwallet','class'=>'form-signin')) !!}
                                    {!! Form::hidden('id', $wallet->id) !!}
                                    <div class="form-group">
                                        {!! Form::label('select_wallet',Lang::get('money_lover.wallet_to_1').':') !!}
                                        {!! Form::select('select_wallet', $wallets, null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('trans_money',Lang::get('money_lover.wallet_to_2').':') !!}
                                        {!! Form::text('trans_money',null, array('class'=>'form-control','placeholder'=>Lang::get('money_lover.wallet_to_2'))) !!}
                                    </div>
                                    {!! Form::submit('Transfer Money',['class' => 'btn btn-success']) !!}

                                </div>
                            </table>
                        </div>
                        {!! Form::close() !!}<!-- /form -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Main Body Section -->
</body>

</html>