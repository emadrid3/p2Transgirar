<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Transgirar') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="display: flex; flex-direction: row; justify-content: space-between; position: sticky; top: 0px; z-index: 10;">
            <div>
                @guest
                @else
                <i class="fas fa-bars fa-2x toggled-2" onclick="event.preventDefault();  $('#wrapper').toggleClass('toggled-2'); $('#wrapper').toggleClass('toggled'); $('#menu ul').hide();" style="margin-right: 20px;">
                </i>
                @endguest
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <i class="fas fa-globe-americas"></i>
                        Transgirar
                </a>
            </div>
            <div>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="main-link-user nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle"></i>
                                    {{ Auth::user()->name  }}
                                </a>
                                <small><b>{{ Auth::user()->email }}</b></small>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-door-open" style=" color: red;"></i>
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
        </nav>

        @guest
        @else
        <div id="wrapper">
            @include('components.sidebar')

      @endguest
      @yield('login')
      <!-- /#sidebar-wrapper -->
      <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                <div class="col-lg-12">
                        @yield('content')
                </div>
                </div>
            </div>
        </div>
      </div>

</body>
</html>

