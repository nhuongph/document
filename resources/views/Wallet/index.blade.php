<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="{!! asset('bootstrap/css/bootstrap.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('css/wallet.css') !!}" rel="stylesheet" type="text/css">
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
                <h1>Wallets</h1>
                <hr>
                <a href="{!! url('addwallet') !!}">
                    Add Wallet
                </a>
                <hr>
                @if(isset($current) && $current != "")
                    <h2>Current Wallet</h2>
                    <div class="alert alert-success">
                        <img id="profile-img" class="profile-img-card" src="{{ $current->image }}" />
                        <ul>
                            <li>{!! $current->name !!}</li>
                            <li>{!! $current->money !!}&nbsp;{!! $current->type_money !!}</li>
                            <li>{!! $current->note !!}</li>
                            <li><a href="{!! url('transwallet') !!}/{!! $current->id !!}">Transfer money other wallet!</a></li>
                            <li>
                                <a href="{!! url('updatewallet') !!}/{!! $current->id !!}">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                </a>&nbsp;
                                <a href="{!! url('deletewallet') !!}/{!! $current->id !!}">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
                <h2>Other Wallets:</h2>
                @foreach($wallets as $var)
                <div class="wallet">
                    <hr>
                    <img id="profile-img" class="profile-img-card" src="{!! $var->image !!}" />
                    <table>
                        <tr><td>{!! $var->name !!}</td></tr>
                        <tr><td>{!! $var->money !!}&nbsp;{!! $var->type_money !!}</td></tr>
                        <tr><td>{!! $var->note !!}</td></tr>
                        <tr><td><a href="{!! url('currentwallet') !!}/{!! $var->id !!}">Set current Wallet</a></td></tr>
                        <tr><td><a href="{!! url('transwallet') !!}/{!! $var->id !!}">Transfer money other wallet!</a></td></tr>
                        <tr><td><a href="{!! url('updatewallet') !!}/{!! $var->id !!}">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            </a>&nbsp;
                                            <a href="{!! url('deletewallet') !!}/{!! $var->id !!}">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </a>
                            </td></tr>
                    </table>
                </div>
                @endforeach
                <hr>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
