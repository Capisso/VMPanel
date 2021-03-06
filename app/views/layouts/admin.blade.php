{{-- Styles --}}

@if(!Config::get('theme.bootswatch'))
{{Asset::queue('bootstrap', 'bootstrap/css/bootstrap.css')}}
@endif



{{Asset::queue('bootstrap-responsive', 'bootstrap/css/bootstrap-responsive.min.css', 'boostrap')}}
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
        {{(isset($title) ? $title : '')}}
    </title>

    @if(Config::get('theme.bootswatch'))
    {{ HTML::style('https://netdna.bootstrapcdn.com/bootswatch/2.3.2/'.Config::get('theme.bootswatch').'/bootstrap.min.css') }}
    @endif

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

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="brand" href="/">{{ Config::get('site.name') }}</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="{{(Request::is('admin/servers*')? 'active' : '')}}">
                        <a href="#">Servers</a>
                    </li>
                    <li class="{{(Request::is('admin/users*')? 'active' : '')}}">
                        {{HTML::linkAction('Admin\UserController@index', 'Users')}}
                    </li>
                    <li class="{{(Request::is('admin/nodes*')? 'active' : '')}}">
                        {{HTML::linkAction('Admin\NodeController@index', 'Nodes')}}
                    </li>
                    <li class="{{(Request::is('admin/regions*')? 'active' : '')}}">
                        {{HTML::linkAction('Admin\RegionController@index', 'Regions')}}
                    </li>
                    <li class="{{(Request::is('admin/addresses*')? 'active' : '')}}">
                        {{HTML::linkAction('Admin\AddressController@index', 'IP Addresses')}}
                    </li>
                    <li class="{{(Request::is('admin/plans*')? 'active' : '')}}">
                        {{HTML::linkAction('Admin\PlanController@index', 'Plans')}}
                    </li>
                    <li class="{{(Request::is('admin/security*')? 'active' : '')}}">
                        {{HTML::linkAction('Admin\Security\HomeController@getIndex', 'Security')}}
                    </li>
                    <li class="{{(Request::is('admin/settings*')? 'active' : '')}}">
                        {{HTML::linkAction('Admin\SettingController@getIndex', 'Settings')}}
                    </li>
                </ul>
                <ul class="nav pull-right">
                    <li class="dropdown {{(Request::is('admin/account*')? 'active' : '')}}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Your Account <b class="caret"></b></a>
                        <ul class="dropdown-menu">
							<li class="{{(Request::is('admin/account/ssh-keys')? 'active' : '')}}">
								{{HTML::linkAction('Admin\AccountController@getSshKeys', 'SSH Keys')}}
							</li>
							<li class="{{(Request::is('admin/account/api-access')? 'active' : '')}}">
								{{HTML::linkAction('Admin\AccountController@getApiAccess', 'API Access')}}
							</li>
							<li class="{{(Request::is('admin/account/settings')? 'active' : '')}}">
								{{HTML::linkAction('Admin\AccountController@getSettings', 'Settings')}}
							</li>
                            <li class="divider"></li>
                            <li>{{HTML::linkAction('AccountController@getLogout', 'Logout')}}</li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container">

    @yield('output')

    <br>

</div><!-- /container -->


@foreach (Asset::getCompiledScripts() as $url)
    {{ HTML::script($url) }}
@endforeach
</body>
</html>
