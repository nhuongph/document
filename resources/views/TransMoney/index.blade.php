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

        <!-- Datepicker Fonts -->
        <link href='{{ asset('datepicker/css/datepicker.css') }}' rel='stylesheet' type='text/css'>

        <!-- Template js -->
        <script src="{{ asset('layouts/js/jquery-2.1.1.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('layouts/js/jquery.appear.js') }}"></script>
        <script src="{{ asset('layouts/js/jqBootstrapValidation.js') }}"></script>
        <script src="{{ asset('layouts/js/modernizr.custom.js') }}"></script>
        <script src="{{ asset('layouts/js/script.js') }}"></script>
        <script src="{!! asset('datepicker/js/bootstrap-datepicker.js') !!}"></script>

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

                        <div class="menu-item color">
                            <a href="{!! url('addtransaction') !!}" data-toggle="modal">
                                <i class="fa fa-pencil-square-o"></i>
                                <p>{{ trans('money_lover.trans_new') }}</p>
                            </a>
                        </div>

                        <div class="menu-item blue">
                            <a href="{!! url('reportmonth') !!}" data-toggle="modal">
                                <i class="fa fa-area-chart"></i>
                                <p>{{ trans('money_lover.trans_report') }}</p>
                            </a>
                        </div>

                    </div>

                    <div class="col-md-9 bg-white padding-top-bot col-md-offset-0">
                        <h1 class="text-center">{{ trans('money_lover.trans_all') }}</h1>
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
                            <div class="col-md-12">
                                {!! Form::open(array('url' => 'seachreport','class'=>'form-signin col-md-8')) !!}
                                <div class="form-group">
                                    {!! Form::label('date_search',Lang::get('money_lover.trans_date').':') !!}
                                    {!! Form::text('date_search',null, array('class'=>'datepicker form-control', 'data-date' => '102/2012' ,'data-date-format' => 'dd/mm/yyyy','placeholder'=>Lang::get('money_lover.trans_date'))) !!}
                                    <script>
                                        $('.datepicker').datepicker();
                                    </script>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('category_id',Lang::get('money_lover.trans_cate').':') !!}
                                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                                </div>
                                {!! Form::submit(Lang::get('money_lover.trans_search'),['class' => 'btn btn-success']) !!}
                                {!! Form::close()!!}
                            </div>
                            <div class="wallet padding-top-bot">
                                <table class="table table-striped">
                                    <tr>
                                        <th>{{ trans('money_lover.avatar') }}</th>
                                        <th>{{ trans('money_lover.trans_name') }}</th>
                                        <th>{{ trans('money_lover.trans_money') }}</th>
                                        <th>{{ trans('money_lover.note') }}</th>
                                        <th>{{ trans('money_lover.action') }}</th>
                                    </tr>
                                    @foreach($transmoneys as $var)
                                    <tr>
                                        <td><img src="{!! $var->image !!}" /></td>
                                        <td>{!! $var->name !!}</td>
                                        <td>{!! $var->money !!}</td>
                                        <td>{!! $var->note !!}</td>
                                        <td>
                                            <a href="{!! url('updatetransaction') !!}/{!! $var->id !!}">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true" title="Edit infor Transaction"></span>
                                            </a>&nbsp;
                                            <a href="{!! url('deletetransaction') !!}/{!! $var->id !!}" title="Delete Transaction">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>  
                                {!! $transmoneys->links() !!}
                            </div>                       
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