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
                <h1>Add Category</h1>
                <hr>
                <a href="{!! url('category') !!}">
                    Index Category
                </a>
                <hr>
                <form class="form-signin" method="post" action="addcategory" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="exampleInputName">Name Category</label>
                        <input type="text" class="form-control" id="nameWallet" placeholder="Name Category" name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNote">Note</label>
                        <textarea rows="4" cols="5" class="form-control" name="note" placeholder="Note..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Select avatar for Categories</label>
                        <input type="file" id="exampleInputFile" name="image">
                        <p class="help-block">Avartar help your easy select Categories.</p>
                    </div>
                    <button type="submit" class="btn btn-default">Create Category</button>
                </form><!-- /form -->
                <hr>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>
