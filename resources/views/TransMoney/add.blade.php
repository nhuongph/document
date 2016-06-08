<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="{!! asset('bootstrap/css/bootstrap.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('css/category.css') !!}" rel="stylesheet" type="text/css">
        <script src="{!! asset('bootstrap/js/bootstrap.js') !!}"></script>

    </head>
    <body>
        <div class="container">
            <h1>Add Transaction</h1>
            <hr>
            <div class="">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <?php echo link_to('/transactions', $title = 'Index Transaction' ,$parameters = array(), $secure = null); ?>
                <hr>
                {!! Form::open(array('url' => 'addtransaction','class'=>'form-signin')) !!}
                    <div class="form-group">
                        {!! Form::label('category_id','Category Transaction:') !!}
                        {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('wallet_id','Walet Transaction:') !!}
                        {!! Form::select('wallet_id', $wallets, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('money','Money:') !!}
                        {!! Form::text('money',null, array('class'=>'form-control')) !!}
                    </div>                    
                    <div class="form-group">
                        {!! Form::label('note','Note:') !!}
                        {!! Form::textarea('note',null, array('class'=>'form-control','placeholder'=>'Note...')) !!}
                    </div>
                    {!! Form::submit('Create Transaction Money',['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
                <hr>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
