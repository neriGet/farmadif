<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="img/logodif.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FARMADIF</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/pvendor/bootstrap/css/bootstrap.min.css">

    <!-- Estilos propios -->
    <link rel="stylesheet" href="/css/estilos.css">

    <!-- Bootstrap notification -->
    <link rel="stylesheet" href="/css/bootstrap-notify.css">
    <link rel="stylesheet" href="/css/styles/alert-bangtidy.css">
    <link rel="stylesheet" href="/css/styles/alert-blackgloss.css">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        FARMADIF
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            {{-- Sin ninguna accion --}}
                            {{-- <li><a href="{{ route('login') }}">Iniciar sesion</a></li> --}}
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Inventarios <span class="caret"></span>
                                </a>
                                
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('ruta_medicamentos_inventario') }}">Medicamentos</a>
                                    </li>
                                    <!-- <li>
                                        <a href="{{ route('ruta_mostrar_medicamentos_totales') }}">Medicamentos totales</a>
                                    </li> -->
                                    <li>
                                        <a href="{{ route('ruta_mostrar_medicementos_vencidos') }}">Medicamentos vencidos</a>
                                    </li>
                                    <!-- <li>
                                        <a href="{{ route('ruta_mostrar_medicamentos_prox_vencer') }}">Medicamentos prox. vencer</a>
                                    </li> -->
                                    <li>
                                        <a href="{{ route('ruta_mostrar_medicamentos_requerido') }}">Medicamentos requeridos</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('ruta_mostrar_medicamentos_entrada') }}">Entrada de medicamentos</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('ruta_mostrar_medicamentos_salida') }}">Salida de medicamentos</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('ruta_beneficiarios') }}">
                                    Beneficiarios
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ruta_donadores') }}">
                                    Donadores
                                    <span class="glyphicon glyphicon-gift" aria-hidden="true"></span>
                                </a>
                            </li>
                             <li>
                                <a href="{{ route('ruta_entrada_medicamentos') }}">
                                    Entrada medicamento
                                    <span class="glyphicon glyphicon-open-file" aria-hidden="true"></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ruta_salida_medicamentos') }}">
                                    Salida medicamento
                                    <span class="glyphicon glyphicon-save-file" aria-hidden="true"></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ruta_solicitudes') }}">
                                    Solicitudes
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            @include('layouts.mensajes')
            @yield('content')
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- JQuery -->
    <script src="/pvendor/jquery/jquery.min.js"></script>

    <!-- Scripts -->
    <script src="/js/entradaMedicamento.js"></script>

    <!-- Script Bootstrap notification -->
    <script src="/js/bootstrap-notify.js"></script>

    <script type="text/javascript">
        $('.notificacion').notify({
            type: 'blackgloss',
            message: { text: $('#mensaje').val() },
            fadeOut: { enabled: true, delay: 8000 }
        }).show();
    </script>

</body>
</html>
