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
                <h1>New Wallet</h1>
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
                {!! Form::open(array('url' => 'addwallet', 'files' => true, 'class'=>'form-signin')) !!}
                    <div class="form-group">
                        {!! Form::label('name','Name Wallet:') !!}
                        {!! Form::text('name',null, array('class'=>'form-control','placeholder'=>'Name Wallet')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('money','Money:') !!}
                        {!! Form::text('money',null, array('class'=>'form-control','placeholder'=>'Your Money')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('type_money','Type Money:') !!}
                        {!! Form::select('type_money', [''=>'--- Select ---','đ'=>'đ','$'=>'$','£'=>'£'], null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('note','Note:') !!}
                        {!! Form::textarea('note', null, ['class' => 'form-control','placeholder'=>"Note..."]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('image','Select avatar for Wallet:') !!}
                        {!! Form::file('image',['class'=>"btn btn-default btn-file form-control"]) !!}
                        <p class="help-block">Avartar help your easy select Wallet.</p>
                    </div>
                <?php echo link_to('/home', $title = 'Cancel' ,$parameters = array('class' => 'btn btn-success'), $secure = null); ?>
                    {!! Form::submit('Register Wallet',['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}<!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
