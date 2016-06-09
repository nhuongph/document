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
                <h1>Add Category</h1>
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
                <a href="{!! url('category') !!}">
                    Index Category
                </a>
                <hr>
                {!! Form::open(array('url' => 'addcategory', 'files' => true, 'class'=>'form-signin')) !!}
                    <div class="form-group">
                        {!! Form::label('category_id','Name Category') !!}
                        {!! Form::text('name',null, array('class'=>'form-control')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('note','Note') !!}
                        {!! Form::textarea('note',null, array('class'=>'form-control','placeholder'=>'Note...')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('image','Select avatar for Categories') !!}
                        {!! Form::file('image',null, array('class'=>'form-control')) !!}
                        <p class="help-block">Avartar help your easy select Categories.</p>
                    </div>
                    {!! Form::submit('Create Category',['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
                <hr>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
