<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="{{asset('/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="#get_key">Get key</a></li>
                    <li><a href="#check">Check content</a></li>
                    <li><a href="#count">Count request</a></li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="container">

        <div class="row" id="get_key">
            <h2 class="text-center bg-success">Get key</h2>
            <div class="col-md-2">
                <form action="{{url('api/v1/get_key')}}" method="post" role="form" id="key-form">
                    <div class="form-group">
                        <label for="">Enter browser name</label>
                        <input type="text" class="form-control" name="browser_name">
                    </div>
                    <button type="submit" class="btn btn-primary">Get key</button>
                </form>
            </div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">List of register users
                    </div>
                    <div class="panel-body" id="key_table">
                        @include('partials.key_table')
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="check">
            <h2 class="text-center bg-success">Check content</h2>
            <div class="col-md-2">
                <form action="{{url('api/v1/check')}}" method="post" role="form" id="check-form">
                    <div class="form-group">
                        <label for="">Enter user key</label>
                        <input type="text" class="form-control" name="user_key">
                    </div>
                    <div class="form-group">
                        <label for="">Enter url</label>
                        <input type="text" class="form-control" name="url">
                    </div>
                    <div class="form-group">
                        <label for="">Enter content</label>
                        <input type="text" class="form-control" name="content">
                    </div>
                    <div class="form-group">
                        <label for="">Enter js</label>
                        <input type="text" class="form-control" name="js_files">
                    </div>
                    <button type="submit" class="btn btn-primary">Verify</button>
                </form>
            </div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Content and urls list
                    </div>
                    <div class="panel-body">
                        <div id="content-table">
                            @include('partials.content_table')
                        </div>
                        <p>&nbsp;</p>
                        <div id="url-table">
                            @include('partials.url_table')
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="count">
            <h2 class="text-center bg-success">Count request</h2>
            <div class="col-md-2">
                <form action="{{url('api/v1/count')}}" method="post" role="form" id="count-form">
                    <div class="form-group">
                        <label for="">Enter user key</label>
                        <input type="text" class="form-control" name="user_key">
                    </div>
                    <button type="submit" class="btn btn-primary">Get statistics</button>
                </form>
            </div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Result
                    </div>
                    <div class="panel-body" id="count-table">
                    </div>
                </div>
            </div>
        </div>
        <p>&nbsp;</p>
    </div>
</div>
<script>
    $(document).ready(function () {

        //add handler to get key form
        $("#key-form").submit(function (event) {
            event.preventDefault();
            $.post("<?php echo url('api/v1/get_key')?>", $("#key-form").serialize() , function (data) {
                $("#key_table").html(data.html);
            });
        });
        //add handler to check form
        $("#check-form").submit(function (event) {
            event.preventDefault();
            $.post("<?php echo url('api/v1/check')?>", $('#check-form').serialize(), function (data) {
                $("#key_table").html(data.key);
                $("#content-table").html(data.content);
                $("#url-table").html(data.url);
            });

        });
        //add handler to count form
        $("#count-form").submit(function (event) {
            event.preventDefault();
            $.post("<?php echo url('api/v1/count')?>", $('#count-form').serialize(), function (data) {
                $("#count-table").html(data.html);
            });

        });
    });
</script>
</body>
</html>
