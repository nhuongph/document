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
                <form class="form-signin" method="post" action="/updatetransaction">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $transaction->id }}">
                    <div class="form-group">
                        <label for="exampleInputName">Category Transaction</label>
                            <select class="form-control" name="category_id">
                            @foreach($categories as $var)
                            <option value="{!! $var->id !!}">{!! $var->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName">Walet Transaction</label>
                        <select class="form-control" name="wallet_id">
                            @foreach($wallets as $var)
                            <option value="{!! $var->id !!}">{!! $var->name !!}({!! $var->type_money !!})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName">Money</label>
                        <input type="text" value="{{ $transaction->money }}" name="money" class="form-control"/>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputName">Note</label>
                        <input type="text" value="{{ $transaction->note }}" name="note" class="form-control"/>
                    </div>
                    <button type="submit" class="btn btn-default">Update Transaction Money</button>
                </form><!-- /form -->
                <hr>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
