<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Horarios</title>
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    
</div>
    <body>
    <nav id="navbar-example2" class="navbar navbar-light bg-light">
    <div class="container">
    <div class="row">      
      <a class="navbar-brand" href="#">Horarios</a>
          <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link" href="/">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <header class="container-fluid">
      <div class="row" style=" background-color:#008080">
        <div class="col12 mx-auto d-block align-self-center text-center">
          <img src="{{asset('imagenes/horarios.jpg')}}" class="img-fluid" width="300px" alt="">
          <h1>Horarios en los cuales se pueden pedir los laboratorios </h1>
        </div>
      </div>
    </header>
    <main class="container-fluid">
      <div class="row" style="height: 680px ; background-color:#008080">
        <div class="col12 text-center text-justify">        
          <h4></h4>
        </div>
       </div>     
    </main>
</html>