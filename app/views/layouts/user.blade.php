{{-- Styles --}}
{{Asset::queue('bootstrap', 'bootstrap/css/bootstrap.css')}}
{{Asset::queue('bootstrap-responsive', 'bootstrap/css/bootstrap-responsive.min.css', 'boostrap')}}
{{Asset::queue('main', 'css/main.css')}}

{{-- Scripts --}}
{{Asset::queue('jquery', 'js/jquery.js')}}
{{Asset::queue('bootstrap', 'bootstrap/js/bootstrap.js', 'jquery')}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{(isset($title) ? $title : '')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

@foreach (Asset::getCompiledStyles() as $url)
    {{ HTML::style($url) }}
@endforeach
        
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="../assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="../assets/ico/favicon.png">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="span3">
                    <h2>{{ Config::get('site.name') }}</h2>
                    <div class="well sidebar-nav">
                        <ul class="nav nav-list">
                            <li class="nav-header">Servers</li>
                            <li class="{{(Request::is('admin/servers*')? 'active' : '')}}">
                                {{ HTML::linkAction('User\ServerController@index', 'example.com') }}
                            </li>
                            @for($i = 0; $i < 4; $i++)
                            <li><a href="#">{{Str::random(6)}}.com</a></li>
                            @endfor
                            <li class="nav-header">Account</li>
                            <li><a href="#"><i class="icon-lock"></i> SSH Keys</a></li>
                            <li><a href="#"><i class="icon-user"></i> Settings</a></li>
                            <li><a href="#"><i class="icon-off"></i> Logout</a></li>
                        </ul>
                    </div>
                    <!--/.well -->
                </div>
                <!--/span-->
                <div class="span9">
                    @if(isset($title))
                    <div class="page-header">
                        <h1>{{{ $title }}} 
                            @if(isset($subtitle))
                            <small>{{{ $subtitle }}}</small>
                            @endif
                        </h1>
                    </div>
                    @endif

                    @yield('content')

                </div>
                <!--/span-->
            </div>
            <!--/row-->
            <hr>
            <footer>
                <p>&copy; {{ Config::get('site.name') }} {{ date('Y', time()) }}</p>
            </footer>
        </div>

@foreach (Asset::getCompiledScripts() as $url)
    {{ HTML::script($url) }}
@endforeach
    </body>
</html>