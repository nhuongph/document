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
                <?php echo link_to('/addtransaction', $title = 'Add Transactions' ,$parameters = array(), $secure = null); ?>
                <br>
                <?php echo link_to('/seachreport', $title = 'Search Transactions' ,$parameters = array(), $secure = null); ?>
                <br>
                <?php echo link_to('/reportmonth', $title = 'Report Month' ,$parameters = array(), $secure = null); ?>
                <hr>
                @foreach($transmoneys as $var)
                <div class="wallet">
                    <hr>
                    <img id="profile-img" class="profile-img-card" src="{!! $var->image !!}" />
                    <div class="form-group">
                        {!! Form::label('category_id','Name Transactions:') !!}
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
                    <div class="form-group">
                        {!! Form::label('action','Action:') !!}
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{!! url('updatetransaction') !!}/{!! $var->id !!}">.
                            {!! Form::label('','',array('class'=>'glyphicon glyphicon-edit','aria-hidden'=>'true')) !!}
                        </a>&nbsp;
                        &nbsp;&nbsp;
                        <a href="{!! url('deletetransaction') !!}/{!! $var->id !!}">
                            {!! Form::label('','',array('class'=>'glyphicon glyphicon-remove','aria-hidden'=>'true')) !!}
                        </a>
                    </div>
                </div>
                @endforeach
                <hr>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
