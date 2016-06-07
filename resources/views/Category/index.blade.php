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
                <h1>Categories</h1>
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
                <a href="{!! url('addcategory') !!}">
                    Add Category
                </a>
                <hr>
                @foreach($categories as $var)
                <div class="wallet">
                    <hr>
                    <img id="profile-img" class="profile-img-card" src="{!! $var->image !!}" />
                    <div class="form-group">
                        <label for="exampCategory">Name Category:</label>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{!! $var->name !!}
                    </div>
                    <div class="form-group">
                        <label for="exampCategory">Note:</label>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{!! $var->note !!}
                    </div>
                    <div class="form-group">
                        <label for="exampCategory">Action:</label>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<a href="{!! url('updatecategory') !!}/{!! $var->id !!}">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </a>&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;<a href="{!! url('deletecategory') !!}/{!! $var->id !!}">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                @endforeach
                <hr>
            </div><!-- /card-container -->
            {!! $categories->links() !!}
        </div><!-- /container -->
    </body>
</html>