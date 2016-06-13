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
                    {{ trans('money_lover.welcome',['name' => Auth::user()->username]) }} | <a href="{!! url('welcome/vi') !!}">Việt Nam</a> &nbsp;<a href="{!! url('welcome/en') !!}">English</a> | <a href="{!! url('logout') !!}">{{ trans('money_lover.logout') }}</a>
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

                        <div class="menu-item blue">
                            <a href="{!! url('addwallet') !!}" data-toggle="modal">
                                <i class="glyphicon glyphicon-star-empty"></i>
                                <p>{{ trans('money_lover.wallet_new') }}</p>
                            </a>
                        </div>

                    </div>

                    <div class="col-md-9 bg-white padding-top-bot col-md-offset-0">
                        <h1 class="text-center">{{ trans('money_lover.wallet') }}</h1>
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
                        @if(isset($current) && $current != "")
                        <h2>{{ trans('money_lover.wallet_current') }}</h2>
                        <div class="alert alert-info wallet">
                            <table class="table table-striped">
                                <tr>
                                    <th>{{ trans('money_lover.wallet_avatar2') }}</th>
                                    <th>{{ trans('money_lover.wallet_name') }}</th>
                                    <th>{{ trans('money_lover.wallet_money') }}({!! $current->type_money !!})</th>
                                    <th>{{ trans('money_lover.wallet_note') }}</th>
                                    <th>{{ trans('money_lover.wallet_action') }}</th>
                                </tr>
                                <tr>
                                    <td><img src="{{ $current->image }}" /></td>
                                    <td>{!! $current->name !!}</td>
                                    <td>{!! $current->money !!}</td>
                                    <td>{!! $current->note !!}</td>
                                    <td>
                                        <a href="{!! url('updatewallet') !!}/{!! $current->id !!}" title="Edit infor wallet">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </a>&nbsp;
                                        <a href="{!! url('transwallet') !!}/{!! $current->id !!}" title="Transfer money to other wallet">
                                            <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>
                                        </a>&nbsp;
                                        <a href="{!! url('deletewallet') !!}/{!! $current->id !!}" title="Delete wallet">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                            </table>                           
                        </div>
                        @endif

                        @if(isset($wallets) && count($wallets) != 0)
                        <h2>{{ trans('money_lover.wallet_other') }}</h2>

                        <div class="wallet">
                            <table class="table table-striped">
                                <tr>
                                    <th>{{ trans('money_lover.wallet_avatar2') }}</th>
                                    <th>{{ trans('money_lover.wallet_name') }}</th>
                                    <th>{{ trans('money_lover.wallet_money') }}</th>
                                    <th>{{ trans('money_lover.wallet_note') }}</th>
                                    <th>{{ trans('money_lover.wallet_action') }}</th>
                                </tr>
                                @foreach($wallets as $var)
                                <tr>
                                    <td><img src="{!! $var->image !!}" /></td>
                                    <td>{!! $var->name !!}</td>
                                    <td>{!! $var->money !!}({!! $var->type_money !!})</td>
                                    <td>{!! $var->note !!}</td>
                                    <td>
                                        <a href="{!! url('currentwallet') !!}/{!! $var->id !!}">
                                            <span class="glyphicon glyphicon-ok" aria-hidden="true" title="Set current wallet"></span>
                                        </a>&nbsp;<a href="{!! url('updatewallet') !!}/{!! $var->id !!}">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true" title="Edit infor wallet"></span>
                                        </a>&nbsp;
                                        <a href="{!! url('transwallet') !!}/{!! $var->id !!}" title="Transfer money to other wallet">
                                            <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>
                                        </a>&nbsp;
                                        <a href="{!! url('deletewallet') !!}/{!! $var->id !!}" title="Delete wallet">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>  

                        </div>
                        @endif
                        {!! $wallets->links() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Main Body Section -->
</body>

</html>