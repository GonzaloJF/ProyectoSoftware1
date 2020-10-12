<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
    .button {
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    }
    .button1 {background-color: #4CAF50;} /* Green */
    .button2 {background-color: #008CBA;} /* Blue */
    .button3 {background-color: #8B0000;} /* RED */
    .button4 {background-color: #5A5A5A;} /*gris*/
    
    </style>

    
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Fullcalendar -->
    <link href='{{ asset('assets/lib/main.css') }}' rel='stylesheet' />
    <script src='{{ asset('assets/lib/main.js') }}'></script>
    <script src={{ asset('assets/lib/locales/es.js') }}></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    @guest   
                    
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-info" href="{{ url('/home') }}">{{ __('Reservas') }}</a>
                        </li>
                        
                    @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="btn btn-outline-info" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            
                            
                        @else
                            @if((Auth::user()->tipo_usuario)==10)
                                    <li class="nav-item">
                                        <a class="btn btn-outline-info" href="{{ url('/register') }}">{{ __('Registrar usuarios') }}</a>
                                    </li>
                                    <p>  &nbsp  </p> 
                                    <li class="nav-item">
                                        <a class="btn btn-outline-info" href="{{ url('/usuarios') }}">{{ __('Lista de usuarios') }}</a>
                                    </li>
                                    <p>  &nbsp  </p> 
                                    <li class="nav-item">
                                        <a class="btn btn-outline-info" href="{{ url('/laboratorio/create') }}">{{ __('Crear Laboratorio') }}</a>
                                    </li>
                                    <p>  &nbsp  </p> 
                                    <li class="nav-item">
                                        <a class="btn btn-outline-info" href="{{ url('/laboratorio') }}">{{ __('Laboratorios') }}</a>
                                    </li>
                            @endif
                            @if(((Auth::user()->tipo_usuario)==1)||((Auth::user()->tipo_usuario)==2)||((Auth::user()->tipo_usuario)==4))
                                <li class="nav-item">
                                    <a class="btn btn-outline-info" href="{{ url('/solicitud') }}">{{ __('Mis Solicitudes') }}</a>
                                </li>
                                <p>  &nbsp  </p> 
                                <li class="nav-item">
                                    <a class="btn btn-outline-info" href="{{ url('/solicitud/create') }}">{{ __('Nueva solicitud') }}</a>
                                </li>
                            @endif
                            @if((Auth::user()->tipo_usuario)==3)
                                <li class="nav-item">
                                    <a class="btn btn-outline-info" href="{{ url('/evaluacion') }}">{{ __('Evaluar Solicitudes') }}</a>
                                </li>
                                <p>  &nbsp  </p> 
                            @endif
                            @if(((Auth::user()->tipo_usuario)==3)||((Auth::user()->tipo_usuario)==5))
                                <li class="nav-item">
                                    <a class="btn btn-outline-info" href="{{ url('/reserva') }}">{{ __('Reservas Creadas') }}</a>
                                </li>
                                <p>  &nbsp  </p> 
                                <li class="nav-item">
                                    <a class="btn btn-outline-info" href="{{ url('/reserva/create') }}">{{ __('Nueva Reserva') }}</a>
                                </li>
                            @endif
                            <p>  &nbsp  </p> 
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="btn btn-outline-secondary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ strtoupper(Auth::user()->name) }}{{ __('') }} {{ strtoupper (Auth::user()->apellido) }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('home/cambiopass') }}">
                                        {{ __('Cambiar contraseña') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
