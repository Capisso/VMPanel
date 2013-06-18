{{-- Styles --}}
{{Asset::queue('bootstrap', 'bootstrap/css/bootstrap.css')}}
{{Asset::queue('main', 'css/main.css')}}

{{-- Scripts --}}
{{Asset::queue('jquery', 'js/jquery.js')}}
{{Asset::queue('bootstrap', 'bootstrap/js/bootstrap.js', 'jquery')}}

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        @yield('title')
    </title>

    @foreach (Asset::getCompiledStyles() as $url)
    {{ HTML::style($url) }}
    @endforeach



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.js"></script>
    <script src="/assets/js/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="/assets/ico/favicon.png">
</head>
<body>

<!-- Page content of course! -->
<!-- Custom styles for this template -->
<style>
    body {
        padding-top: 60px;
    }
    .starter-template {
        padding: 40px 15px;
        text-align: center;
    }
</style>


<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Example Company</a>
        <div class="nav-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Servers</a></li>
                <li><a href="#about">Snapshots</a></li>
                <li><a href="#contact">API</a></li>
            </ul>

            <ul class="nav navbar-nav pull-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Your Account <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">SSH Keys</a></li>
                        <li><a href="#">API Access</a></li>
                        <li><a href="#">Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="col col-lg-3">
            <ul class="nav nav-pills nav-stacked">
                <li class="nav-header">Your Servers</li>
                <li class="active"><a href="" class="text-success">example.com</a></li>
                <li><a href="" class="text-success">{{Str::random(5)}}.example.com</a></li>
                <li><a href="" class="text-success">{{Str::random(5)}}.example.com</a></li>
                <li><a href="" class="text-warning">{{Str::random(5)}}.example.com</a></li>
                <li><a href="" class="text-danger">{{Str::random(5)}}.example.com</a></li>
                <li><a href="" class="text-muted">{{Str::random(5)}}.example.com</a></li>

                <li class="nav-header">Quick Links</li>

            </ul>
        </div>

        <div class="col col-lg-9">
            @yield('content')
        </div>
    </div>

</div><!-- /container -->

@foreach (Asset::getCompiledScripts() as $url)
{{ HTML::script($url) }}
@endforeach

</body>
</html>
