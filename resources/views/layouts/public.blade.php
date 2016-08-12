<html>

<head>
    <title>Recipes | @yield('htmlheader_title', 'Title')</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">


{!! OpenGraph::generate() !!}
{!! Twitter::generate() !!}
{!! SEOMeta::generate() !!}


<!-- Styles -->
    <link href="{{ asset('/node_modules/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/public/css/theme.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/node_modules/cd-font-awesome/index.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/node_modules/nprogress/nprogress.css') }}" rel="stylesheet" type="text/css"/>
    @yield('styles')
</head>

<body>

<div class="container-fluid top_header">
    <div class="row">
        <div class="container">
            <div class="col-lg-3 pull-right">

                <form method="get" id="searchform" class="search_form" action="{{ route('web.search') }}">
                    <div class="input-group">
                        <input type="text" class="form-control searchform"
                               placeholder="{{trans('phrases.search_receipts')}}" name="search">
                        <span class="input-group-btn">
        <button class="btn search-button" type="submit"></button>

                    </span>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
<div class="container-fluid top_header_logo">
    <div class="row">
        <div class="container">
            <div class="logo_main">
                <a href="{{ route('web.homepage') }}"> <img src="{{ asset('/public/images/logo.png') }}"/></a>
            </div>
        </div>
    </div>
</div>


<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse"><span
                        class="sr-only">{{trans('phrases.toggle_navigation')}} </span><span
                        class="icon-bar"></span><span
                        class="icon-bar"></span><span class="icon-bar"></span></button>

        </div>
        <div class="collapse navbar-collapse" id="navbar-ex-collapse">
            <ul class="nav navbar-nav navbar-left">

                <li {{ (Request::is('/') ? 'class=active' : '') }}><a href="{{ route('web.homepage') }}"><i
                                class="fa fa-home" aria-hidden="true"></i> {{trans('words.homepage')}}</a></li>
                @if (Auth::guest())
                    <li {{ (Request::is('login') ? 'class=active' : '') }}><a href="{{ route('login.get') }}"><i
                                    class="fa fa-sign-in" aria-hidden="true"></i> {{trans('words.login')}}</a></li>
                    <li {{ (Request::is('register') ? 'class=active' : '') }}><a href="{{ route('register.get') }}"><i
                                    class="fa fa-user-plus" aria-hidden="true"></i> {{trans('words.register')}}</a></li>
                @else
                    <li {{ (Request::is('profile') ? 'class=active' : '') }}><a href="{{ route('user.profile') }}"><i
                                    class="fa fa-user" aria-hidden="true"></i> {{trans('words.my_profile')}}</a></li>
                    <li {{ (Request::is('items') ? 'class=active' : '') }}><a href="{{ route('user.items') }}"><i
                                    class="fa fa-cutlery" aria-hidden="true"></i> {{trans('words.my_recipes')}} </a>
                    </li>
                    <li {{ (Request::is('items/insert') ? 'class=active' : '') }}><a
                                href="{{ route('user.items.create') }}"><i class="fa fa-plus"
                                                                           aria-hidden="true"></i> {{trans('words.add_new_recipe')}}
                        </a></li>
                    <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                    </li>
                @endif

            </ul>


        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="row">
                        <h1>@yield('contentheader_title', 'Header')</h1>
                        <hr/>
                    </div>
                    @yield('main-content')
                </div>
            </div>

            <div class="col-md-3 pull-right">
                @yield('sidebar', 'Default sidebar')
            </div>
        </div>
    </div>
</div>

<div id='goTop'></div>
<a href="https://github.com/IvanSostarko/laravel-5-2-cook-book">
    <img style="position: absolute; top: 0; right: 0; border: 0;"
            src="https://camo.githubusercontent.com/652c5b9acfaddf3a9c326fa6bde407b87f7be0f4/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6f72616e67655f6666373630302e706e67"
            alt="Fork me on GitHub"
            data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_orange_ff7600.png"></a>

<!-- Google Analytics code -->
{{ $google_analytic  }}

<!-- JS -->
<script type="text/javascript" src="{{ asset('/node_modules/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/node_modules/jquery-lazyload/jquery.lazyload.js') }}"></script>
<script type="text/javascript" src="{{ asset('/node_modules/nprogress/nprogress.js') }}"></script>
<script type="text/javascript" src="{{ asset('/node_modules/jquery-gotop/src/jquery.gotop.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/public/js/main.js') }}"></script>
@yield('scripts')


</body>
</html>
