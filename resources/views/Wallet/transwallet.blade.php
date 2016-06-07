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
                <form class="form-signin" method="post" action="/transwallet">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="wallet">
                        <input type="hidden" name="id" value="{!! $wallet->id !!}">
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
                                    <label for="exampleSelectWallet">Select Wallet for transfer</label>
                                    <select name='select_wallet' class="form-control">
                                        @foreach($wallets as $var)
                                            <option value="{!! $var->id !!}">{!! $var->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectWallet">Input money</label>
                                    <input type="text" name='trans_money' class="form-control"/>
                                </div>
                                <tr><td><button type="submit" class="btn btn-default">Transfer Money</button></td></tr>
                            </table>
                        </div>
                </form><!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
