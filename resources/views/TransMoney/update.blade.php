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
                <h1>Update Transaction</h1>
                <hr>
                <a href="{!! url('transactions') !!}">
                    Index Transaction
                </a>
                <hr>
                {!! Form::open(array('url' => '/updatetransaction','class'=>'form-signin')) !!}
                    {!! Form::hidden('id', $transaction->id) !!}
                    <div class="form-group">
                        {!! Form::label('category_id','Category Transaction:') !!}
                        {!! Form::select('category_id', $categories, $transaction->category_id, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('wallet_id','Walet Transaction:') !!}
                        {!! Form::select('wallet_id', $wallets, $transaction->wallet_id, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('money','Money:') !!}
                        {!! Form::text('money',$transaction->money, array('class'=>'form-control')) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('note','Note:') !!}
                        {!! Form::textarea('note',$transaction->note, array('class'=>'form-control','placeholder'=>'Note...')) !!}
                    </div>
                    {!! Form::submit('Update Transaction Money',['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
                <hr>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
