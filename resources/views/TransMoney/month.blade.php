<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <script src="{!! asset('js/jquery-1.11.3.min.js') !!}"></script>
        <link href="{!! asset('bootstrap/css/bootstrap.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('css/category.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('datepicker/css/datepicker.css') !!}" rel="stylesheet" type="text/css">
        <script src="{!! asset('bootstrap/js/bootstrap.js') !!}"></script>
        <script src="{!! asset('datepicker/js/bootstrap-datepicker.js') !!}"></script>

    </head>
    <body>
        <div class="container">
            <div class="">
                <h1>Transactions management</h1>
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
                <a href="{!! url('transactions') !!}">
                    Index Transactions
                </a>
                <hr>
                <form class="form-signin" method="post" action="/monthtransaction">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="exampleInputName">Select Month Transaction</label>
                        <br>
<!--                        <div class="input-append date" id="dpMonths" data-date="102/2012" data-date-format="mm/yyyy" data-date-viewmode="months" data-date-minviewmode="years">
                            <input name="month" class="span2" size="16" type="text" value="02/2012" readonly="">
				<span class="add-on"><i class="icon-calendar"></i></span>
			</div>-->
                        <input name="month" class="datepicker" data-date="102/2012" data-date-format="mm/yyyy" data-date-viewmode="months" data-date-minviewmode="years"/>
                        <script>
                            $('.datepicker').datepicker();
                        </script>
                    </div>
                    <button type="submit" class="btn btn-default">Report Transaction</button>
                </form><!-- /form -->
                <hr>
                @foreach($transmoneys as $var)
                <div class="wallet">
                    <hr>
                    <img id="profile-img" class="profile-img-card" src="{!! $var->image !!}" />
                    <div class="form-group">
                        <label for="exampCategory">Name Transactions:</label>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{!! $var->name !!}
                    </div>
                    <div class="form-group">
                        <label for="exampCategory">Note:</label>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{!! $var->note !!}
                    </div>
                    <div class="form-group">
                        <label for="exampCategory">Money</label>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{!! $var->money !!} &nbsp;{!! $var->type_money !!}
                    </div>
                    <div class="form-group">
                        <label for="exampCategory">Action:</label>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<a href="{!! url('updatetransaction') !!}/{!! $var->id !!}">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </a>&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;<a href="{!! url('deletetransaction') !!}/{!! $var->id !!}">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                @endforeach
                <hr>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
