<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <script src="{!! asset('js/jquery-1.11.3.min.js') !!}"></script>
        <link href="{!! asset('bootstrap/css/bootstrap.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('css/mycss.css') !!}" rel="stylesheet" type="text/css">
        <script src="{!! asset('bootstrap/js/bootstrap.js') !!}"></script>

    </head>
    <body>
        <div class="container">
            <div class="">
                <h1>
                    Transfer money between Wallets!
                </h1>
                <hr>
                <!--*************-->
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
                          <li class="dropdown active">
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
                          <li class="dropdown">
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
                {!! Form::open(array('url' => 'transwallet','class'=>'form-signin')) !!}
                    <div class="wallet">
                        <img id="profile-img" class="profile-img-card" src="{!! url($wallet->image) !!}" />
                        <table>
                            <tr><th>Name of Wallet:</th><td>{!! $wallet->name !!}</td></tr>
                            <tr><th>Money in Wallet:</th><td>{!! $wallet->money !!}&nbsp;{!! $wallet->type_money !!}</td></tr>
                            <tr><th>Note of Wallet:</th><td>{!! $wallet->note !!}</td></tr>     
                        </table>
                        {!! Form::hidden('id', $wallet->id) !!}
                    </div>
                    <div class="chose_wallet"> 
                            <table class="table table-hover">
                                <hr>
                                <h2>Transfer money</h2>
                                <div class="form-group">
                                    {!! Form::label('select_wallet','Select Wallet for transfer:') !!}
                                    {!! Form::select('select_wallet', $wallets, null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('trans_money','Input money:') !!}
                                    {!! Form::text('trans_money',null, array('class'=>'form-control')) !!}
                                </div>
                                {!! Form::submit('Transfer Money',['class' => 'btn btn-success']) !!}
                            </table>
                        </div>
                {!! Form::close() !!}<!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
