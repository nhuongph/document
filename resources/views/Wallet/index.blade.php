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
                <h1>Wallets</h1>
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
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <hr>
                @if(isset($current) && $current != "")
                    <h2>Current Wallet</h2>
                    <div class="alert alert-success wallet">
                        <img id="profile-img" class="profile-img-card" src="{{ $current->image }}" />
                        <table>
                            <tr><th>Name of Wallet:</th><td>{!! $current->name !!}</td></tr>
                            <tr><th>Money in Wallet:</th><td>{!! $current->money !!}&nbsp;{!! $current->type_money !!}</td></tr>
                            <tr><th>Note of Wallet:</th><td>{!! $current->note !!}</td></tr>                            
                            <tr><th>Action</th>
                                <td>
                                    <a href="{!! url('updatewallet') !!}/{!! $current->id !!}">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                </a>&nbsp;
                                <a href="{!! url('deletewallet') !!}/{!! $current->id !!}">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </a>
                            </td></tr>
                            <tr><th>&nbsp;</th><td><a href="{!! url('transwallet') !!}/{!! $current->id !!}">Transfer money other wallet!</a></td></tr>
                        </table>
                    </div>
                @endif
                
                @if(isset($wallets) && count($wallets) != 0)
                <h2>Other Wallets:</h2>
                @foreach($wallets as $var)
                <div class="wallet">
                    <hr>
                    <img id="profile-img" class="profile-img-card" src="{!! $var->image !!}" />
                    <table>
                        <tr><th>Name of Wallet</th><td>{!! $var->name !!}</td></tr>
                        <tr><th>Money in Wallet</th><td>{!! $var->money !!}&nbsp;{!! $var->type_money !!}</td></tr>
                        <tr><th>Note of Wallet</th><td>{!! $var->note !!}</td></tr>
                        <tr><th>Action</th><td><a href="{!! url('updatewallet') !!}/{!! $var->id !!}">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            </a>&nbsp;
                                            <a href="{!! url('deletewallet') !!}/{!! $var->id !!}">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </a>
                            </td></tr>
                        
                        <tr><th>&nbsp;</th><td><a href="{!! url('currentwallet') !!}/{!! $var->id !!}">Set current Wallet</a></td></tr>
                        <tr><th>&nbsp;</th><td><a href="{!! url('transwallet') !!}/{!! $var->id !!}">Transfer money other wallet!</a></td></tr>
                    </table>
                </div>
                @endforeach
                <hr>
                @endif
            </div><!-- /card-container -->
            {!! $wallets->links() !!}
        </div><!-- /container -->
    </body>
</html>
