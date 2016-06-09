<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <script src="{!! asset('js/jquery-1.11.3.min.js') !!}"></script>
        <link href="{!! asset('bootstrap/css/bootstrap.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('css/category.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('datepicker/css/datepicker.css') !!}" rel="stylesheet" type="text/css">
        <script src="{!! asset('bootstrap/js/bootstrap.js') !!}"></script>        
        <link href="{!! asset('css/mycss.css') !!}" rel="stylesheet" type="text/css">
        <script src="{!! asset('datepicker/js/bootstrap-datepicker.js') !!}"></script>

    </head>
    <body>
        <div class="container">
            <div class="">
                <h1>Search Transactions management</h1>
                <hr>

                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="{!! url('home') !!}">Money Lover</a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="{!! url('home') !!}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Wallets <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{!! url('home') !!}">All Wallets</a></li>
                                        <li><a href="{!! url('addwallet') !!}">New Wallet</a></li>                              
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="{!! url('category') !!}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{!! url('category') !!}">All Wallets</a></li>     
                                        <li><a href="{!! url('addcategory') !!}">New Categories</a></li>                              
                                    </ul>
                                </li>
                                <li class="dropdown active">
                                    <a href="{!! url('transactions') !!}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Transactions Money <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{!! url('transactions') !!}">All Transactions</a></li>    
                                        <li><a href="{!! url('addtransaction') !!}">New Transaction</a></li> 
                                        <li><a href="{!! url('seachreport') !!}">Search Transactions</a></li>    
                                        <li><a href="{!! url('reportmonth') !!}">Report Month</a></li>   
                                    </ul>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="{!! url('update') !!}/{!! Auth::user()->username !!}">Update user</a></li>
                                <li><a href="{!! url('logout') !!}">Logout</a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
                <!--*******************-->
                <hr>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                {!! Form::open(array('url' => 'seachreport','class'=>'form-signin col-md-5')) !!}
                <div class="trans-search">
                    <div class="form-group">
                        {!! Form::label('date_search','Select Month Transaction:') !!}
                        {!! Form::text('date_search',null, array('class'=>'datepicker form-control', 'data-date' => '102/2012' ,'data-date-format' => 'dd/mm/yyyy')) !!}
                        <script>
                            $('.datepicker').datepicker();
                        </script>
                    </div>
                    <div class="form-group">
                        {!! Form::label('category_id','Category Transaction:') !!}
                        {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                    </div>
                    {!! Form::submit('Search Transaction',['class' => 'btn btn-success']) !!}
                    {!! Form::close()!!}
                </div>
                <hr>
                @foreach($transmoneys as $var)
                <div class="trans">
                    <hr>
                    <img id="profile-img" class="profile-img-card" src="{!! $var->image !!}" />
                    <table class="trans-right"
                           <tr><th>
                                {!! Form::label('category_id','Name Transactions:') !!}
                            </th><td>
                                &nbsp;&nbsp;&nbsp;&nbsp;{!! $var->name !!}
                            </td></tr>
                        <tr><th>
                                {!! Form::label('note','Note:') !!}
                            </th><td>
                                &nbsp;&nbsp;&nbsp;&nbsp;{!! $var->note !!}
                            </td></tr>
                        <tr><th>
                                {!! Form::label('money','Money:') !!}
                            </th><td>
                                &nbsp;&nbsp;&nbsp;&nbsp;{!! $var->money !!} &nbsp;{!! $var->type_money !!}
                            </td></tr>
                    </table>
                </div>
                @endforeach
                <hr>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
