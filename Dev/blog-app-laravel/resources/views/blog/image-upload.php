<!DOCTYPE html>
<html>
<head>
    <title>laravel 8 image upload example - ItSolutionStuff.com.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
<div class="container">

    <div class="panel panel-primary">
      <div class="panel-heading"><h2>laravel 8 image upload example - ItSolutionStuff.com.com</h2></div>
      <div class="panel-body">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        <img src="images/{{ Session::get('image') }}">
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-md-6">
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>

            </div>
        </form>

        //add_image.blade.php
        <div class="container">
            <form method="post" action="{{ route('images.store') }}"
                    enctype="multipart/form-data">
                @csrf
                <div class="image">
                <label><h4>Add image</h4></label>
                <input type="file" class="form-control" required name="image">
                </div>

                <div class="post_button">
                <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>

      </div>
    </div>
</div>
</body>

</html>

