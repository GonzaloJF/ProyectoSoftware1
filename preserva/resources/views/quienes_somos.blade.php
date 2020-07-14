<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>¿Quienes somos?</title>
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    
</div>
    <body>
    <nav id="navbar-example2" class="navbar navbar-light bg-light">
    <div class="container">
    <div class="row">      
      <a class="navbar-brand" href="#">¿Quienes somos?</a>
          <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link" href="/">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login">Login</a>
            </li>
            <li class="nav-iten">
              <a class="nav-link" href="register">registrarse</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <header class="container-fluid">
      <div class="row" style="height: 680px; background-color:#008080">
        <div class="rounded mx-auto d-block align-self-center ">
          <img src="{{asset('imagenes/imagen1.png')}}" class="img-fluid  " width="600px" alt="">
        </div>
        <div class="text-center">        
          <h1 >Somos Un Grupo de Estudiantes de la Universidad Catolica Del Maule</h1>
          <p class="text-center">Creamos un proyecto de ingenieria en Software 1, con el que se hara una pagina de registros de reservas de los distintos laboratorios que hay en la universidad.</p>
        </div>
      </div>
    </header>
</html>
