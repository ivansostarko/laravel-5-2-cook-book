<html>

<head>
    <meta name="keywords" content="keywords">
    <meta name="description" content="desc">
    <title>Recipes | @yield('htmlheader_title', 'Title')</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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



            </div>
        </div>

    </div>
</div>
<div class="container-fluid top_header_logo">
    <div class="row">
        <div class="container">
            <div class="logo_main">
                <a href=""> <img src="{{ asset('/public/images/logo.png') }}" /></a>
            </div>
        </div>
    </div>
</div>


<div class="navbar navbar-default navbar-green">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>

        </div>
        <div class="collapse navbar-collapse" id="navbar-ex-collapse">
            <ul class="nav navbar-nav navbar-left">

                <li {{ (Request::is('admin/dashboard') ? 'class=active' : '') }}><a href="{{ route('admin.dashboard') }}"><i class="fa fa-line-chart" aria-hidden="true"></i> Dashboard</a></li>
                <li {{ (Request::is('admin/activities') ? 'class=active' : '') }}><a href="{{ route('admin.activities') }}"><i class="fa fa-database" aria-hidden="true"></i> Activities</a></li>
                    <li {{ (Request::is('admin/admins') ? 'class=active' : '') }}><a href="{{ route('admin.admins') }}"><i class="fa fa-user" aria-hidden="true"></i> Admins</a></li>
                    <li {{ (Request::is('admin/users') ? 'class=active' : '') }}><a href="{{ route('admin.users') }}"><i class="fa fa-users" aria-hidden="true"></i> Users</a></li>
                <li {{ (Request::is('admin/categories') ? 'class=active' : '') }}><a href="{{ route('admin.categories') }}"><i class="fa fa-file" aria-hidden="true"></i> Categories</a></li>
                <li {{ (Request::is('admin/items') ? 'class=active' : '') }}><a href="{{ route('admin.items') }}"><i class="fa fa-cutlery" aria-hidden="true"></i> Items</a></li>
                <li {{ (Request::is('admin/settings') ? 'class=active' : '') }}><a href="{{ route('admin.settings') }}"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                    <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>


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
                        <h1>@yield('contentheader_title', '')</h1>
                        <hr />
                    </div>
                    @yield('main-content')
                </div>
            </div>

            <div class="col-md-3 pull-right">
                @yield('sidebar', '')
            </div>
        </div>
    </div>
</div>
<div id='goTop'></div>
<a href="https://github.com/IvanSostarko/laravel-5-2-cook-book"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/e7bbb0521b397edbd5fe43e7f760759336b5e05f/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677265656e5f3030373230302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_green_007200.png"></a>




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
