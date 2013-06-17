<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>

        Starter template &middot; Bootstrap

    </title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet">



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
                <li><a href="#">Servers</a></li>
                <li class="active"><a href="#about">Users</a></li>
                <li><a href="#contact">Machines</a></li>
                <li><a href="#contact">IP Addresses</a></li>
                <li><a href="#contact">Settings</a></li>
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

    @yield('content')

</div><!-- /container -->


<!-- JS and analytics only. -->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/assets/js/jquery.js"></script>
<script src="/assets/bootstrap/js/bootstrap.js"></script>

<script src="/assets/js/application.js"></script>


</body>
</html>
