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
                {!! Form::open(array('url' => 'reportmonth','class'=>'form-signin col-md-5')) !!}
                    <div class="form-group">
                        {!! Form::label('month','Select Month Transaction:') !!}
                        {!! Form::text('month',null, array('class'=>'datepicker form-control', 'data-date' => '102/2012' ,'data-date-format' => 'mm/yyyy', 'data-date-viewmode' => 'months', 'data-date-minviewmode'=>'years')) !!}
                        <script>
                            $('.datepicker').datepicker();
                        </script>
                    </div>
                    {!! Form::submit('Month Report',['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
                <hr>
                @foreach($transmoneys as $var)
                <div class="wallet row col-md-12">
                    <hr>
                    <img id="profile-img" class="profile-img-card" src="{!! $var->image !!}" />
                    <div class="form-group">
                        {!! Form::label('name','Name Transactions:') !!}
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{!! $var->name !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('note','Note:') !!}
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{!! $var->note !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('money','Money:') !!}
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{!! $var->money !!} &nbsp;{!! $var->type_money !!}
                    </div>
                </div>
                @endforeach
                <hr>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
