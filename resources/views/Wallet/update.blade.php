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
                <form class="form-signin" method="post" action="/updatewallet" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="current" value="{{ Auth::user()->current }}">
                    <div class="form-group">
                        <label for="exampleInputName">Name Wallet</label>
                        <input type="text" class="form-control" id="nameWallet" placeholder="Name Wallet" name="name" value="{!! $wallet['name'] !!}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputMoney">Money</label>
                        <input type="text" class="form-control" id="nameWallet" placeholder="Your Money" name="money" value="{!! $wallet['money'] !!}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTypeMoney">Type Money</label>
                        <select name="type_money" class="form-control">
                            <option value="">---</option>
                            <option value="đ">đ</option>
                            <option value="$">$</option>
                            <option value="£">£</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNote">Note</label>
                        <textarea rows="4" cols="5" class="form-control" name="note" placeholder="Note..." value="{!! $wallet['note'] !!}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Select avatar for Wallet</label>
                        <input type="file" id="exampleInputFile" name="image" value="{!! $wallet['image'] !!}">
                        <p class="help-block">Avartar help your easy select Wallet.</p>
                    </div>
                    <button type="submit" class="btn btn-default">Update Wallet</button>
                </form><!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
