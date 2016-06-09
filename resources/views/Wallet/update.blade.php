<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="{!! asset('bootstrap/css/bootstrap.css') !!}" rel="stylesheet" type="text/css">
        <script src="{!! asset('bootstrap/js/bootstrap.js') !!}"></script>

    </head>
    <body>
        <div class="container">
            <div class="">
                <h1>Update Wallet</h1>
                <a href="{!! url('home') !!}" class="forgot-password">
                    Index Wallets!
                </a>
                <br>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(array('url' => 'updatewallet', 'files' => true, 'class'=>'form-signin')) !!}                    
                    {!! Form::hidden('id', $wallet->id) !!}
                    <div class="form-group">
                        {!! Form::label('name','Name Wallet:') !!}
                        {!! Form::text('name',$wallet->name, array('class'=>'form-control')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('money','Money:') !!}
                        {!! Form::text('money',$wallet->money, array('class'=>'form-control')) !!}
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
                        {!! Form::file('image') !!}
                        <p class="help-block">Avartar help your easy select Wallet.</p>
                    </div>
                    {!! Form::submit('Update Wallet',['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}<!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
