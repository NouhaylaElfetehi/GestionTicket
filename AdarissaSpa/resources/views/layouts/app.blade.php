<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cité Des Sport Adarissa</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{url('images/favicon.png')}}"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{ asset('css/side-bar.css') }}" rel="stylesheet">
</head>
<body>
<div class="d-flex" id="wrapper">
    @can('connected')
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper" >
        <div class="sidebar-heading"><img src="{{url('images/2.png')}}" width="200" /></div>
        <div class="list-group list-group-flush" >

            @can('manage-users')
                <a  href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action bg-light">
                    Users Management
                </a>
            @endcan
                <a class="list-group-item list-group-item-action bg-light" href="#otherSectionsClient" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="otherSectionsClient">
                    Manage Clients  <i class="fas fa-angle-down"></i>
                </a>
                <ul  class="collapse list-unstyled" id="otherSectionsClient">
                    <li>
                        <a style="color: grey; padding-left: 40% ;" class="scroll-link" href="/client/create">Create Client</a>
                    </li>
                    <li>
                        <a style="color: grey; padding-left: 40% ;" class="scroll-link" href="/client/search">Search Client</a>
                    </li>
                    <li>
                        <a style="color: grey; padding-left: 40% ;" class="scroll-link" href="/client/all">All Clients</a>
                    </li>
                </ul>

            <a class="list-group-item list-group-item-action bg-light" href="#otherSectionsTicket" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="otherSectionsTicket">
                Manage Tickets  <i class="fas fa-angle-down"></i>
            </a>
            <ul  class="collapse list-unstyled" id="otherSectionsTicket">
                <li>
                    <a style="color: grey; padding-left: 40% ;" class="scroll-link" href="/ticket/check">Check Ticket</a>
                </li>
                <li>
                    <a style="color: grey; padding-left: 40% ;" class="scroll-link" href="/ticket/search">Search Ticket</a>
                </li>
                <li>
                    <a style="color: grey; padding-left: 40% ;" class="scroll-link" href="/ticket/all">All Tickets</a>
                </li>
            </ul>

            <a class="list-group-item list-group-item-action bg-light" href="#otherSectionsAchats" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="otherSectionsAchats">
                Manage Achats  <i class="fas fa-angle-down"></i>
            </a>
            <ul  class="collapse list-unstyled" id="otherSectionsAchats">
                <li>
                    <a style="color: grey; padding-left: 40% ;" class="scroll-link" href="/achat/create">Realiser Achat</a>
                </li>
                <li>
                    <a style="color: grey; padding-left: 40% ;" class="scroll-link" href="/achat/search">Search Achat</a>
                </li>
                <li>
                    <a style="color: grey; padding-left: 40% ;" class="scroll-link" href="/achat/all">All Achats</a>
                </li>
            </ul>

        </div>
    </div>
    <!-- /#sidebar-wrapper -->
    @endcan
    <!-- Page Content -->

    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            @guest
                <a class="nav-link text-dark" href="/">Cite Des Sport Adarissa <span class="sr-only">(current)</span></a>
            @else
            <button class="btn btn-dark" id="menu-toggle">Menu</button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @endguest

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->

                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    @can('connected')
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    @endcan
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->firstname }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <!--
                            @can('manage-users')
                                <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                    User Management
                                </a>
                            @endcan -->

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
<script>
    jQuery(document).ready(function($){
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    })
</script>

</body>
</html>
