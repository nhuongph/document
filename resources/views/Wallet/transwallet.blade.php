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
                <h1>
                    Transfer money between Wallets!
                </h1>
                <a href="{!! url('home') !!}" class="forgot-password">
                    Index Wallets!
                </a>
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
                        <input type="hidden" name="id" value="{!! $wallet->id !!}">
                        {!! Form::hidden('id', $wallet->id) !!}
                        <table class="table">
                            <tr>
                                <td><img id="profile-img" class="profile-img-card" src="{!! url($wallet->image) !!}" /></td>
                            </tr>
                            <tr>
                                <td>{!! $wallet->name !!}</td>
                            </tr>
                            <tr><td>{!! $wallet->money !!}&nbsp;{!! $wallet->type_money !!}</td></tr>
                            <tr>
                                <td>{!! $wallet->note !!}&nbsp;</td>
                            </tr>
                        </table>                        
                    </div>
                    <div class="chose_wallet"> 
                            <table class="table table-hover">
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
                </form><!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
