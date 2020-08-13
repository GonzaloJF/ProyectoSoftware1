<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bienvenidos A Reservas UCM.</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: 3px;
                text-decoration: none;
                text-transform: uppercase;
            }

            .barra > a {
                color: #45ABC6;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 900;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .barralab > a {
                color: #5DBBF9;
                padding: 0 25px;
                font-size: 20px;
                font-weight: 900;
                letter-spacing: 8px;
                text-decoration: none;
                text-transform: uppercase;
            }


            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right barra ">
                    @auth
                        <a href="{{ url('/home') }}">Reservas</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                    @endauth
                </div>
            @endif

            <div class="content">            
                <div class="barralab">
                    <a href="{{ url('/laboratorio') }}">Laboratorios</a>
                    <a href="{{ url('/horarios') }}">Horarios</a>
                </div>               
                    <div class="title m-b-md">
                        Bienvenidos A Reservas UCM.
                    </div>
                <div class="links">
                    <a href="quienes_somos">¿Quienes somos?</a>
                    <a href="https://portal.ucm.cl/">Portal Universidad</a> 
                </div>
            </div>
        </div>
    </body>
</html>
