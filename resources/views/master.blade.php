<!DOCTYPE html>
<html lan g="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
<<<<<<< HEAD
  Latest compiled and minified CSS & JS -->
  <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
  @yield('extrastyles')
</head>

<body>

  <div id="app">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">

    <!-- Navbar (sit on top) -->
    <div class="w3-top">
      <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
        <router-link class="w3-bar-item w3-button" to="/">Food@Home</router-link>
        <!-- Right-sided navbar links. Hide them on small screens -->
        <div class="w3-right w3-hide-small">
          <router-link class="w3-bar-item w3-button" to="/register">Register</router-link>
          <router-link class="w3-bar-item w3-button" to="/login">Login</router-link>
        </div>
      </div>
    </div>

    <div style="padding-top: 5rem">
      <router-view></router-view>
    </div>

  </div>

  <script src="{{ mix('js/app.js') }}"></script>

</body>

<!-- Footer 
<footer class="w3-center w3-light-grey w3-padding-32">
<p>Trabalho realizado em âmbito da UC desenvolvimento de aplicações distribuidas <a href="" target="_blank" class="w3-hover-text-green"></a></p>
</footer>
-->

=======
  <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
  <!-- <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}"> -->

  @yield('extrastyles')
</head>

<style>
  body {
    font-family: "Times New Roman", Georgia, Serif;
  }

  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    font-family: "Playfair Display";
    letter-spacing: 5px;
  }
</style>

<body>
  <div class="container" id="app">
    <!-- Navbar (sit on top) -->
    <!-- <div class="navbar navbar-default navbar-fixed-top">
      <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
        <a class="w3-bar-item w3-button">Food@Home</a>
        <div class="w3-right w3-hide-small">
          <router-link class="w3-bar-item w3-button" to="/register">Register</router-link>
          <router-link class="w3-bar-item w3-button" to="/">Main</router-link>
          <router-link class="w3-bar-item w3-button" to="/products">Menu</router-link>
          <router-link class="w3-bar-item w3-button" to="/management">Users</router-link>
        </div>
      </div>
    </div> -->


    <nav class="mb-1 navbar navbar-expand-lg navbar-light info-color">
      <a class="navbar-brand">Food@Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <router-link class="nav-link waves-effect waves-light" to="/register">Register</router-link>
          </li>
          <li class="nav-item active">
            <router-link class="nav-link waves-effect waves-dark" to="/management">Manage</router-link>
          </li>
          <li class="nav-item active">
            <router-link class="nav-link waves-effect waves-dark" to="/">Main</router-link>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <i class="fas fa-user"></i> Profile </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
              <a class="dropdown-item waves-effect waves-light" href="#">My account</a>
              <a class="dropdown-item waves-effect waves-light" href="#">Log out</a>
            </div>
          </li> -->
        </ul>
      </div>
    </nav>

    @yield('content')
  </div>

  @yield('pagescript')
</body>

>>>>>>> e126d831cf225c5141daf42dd01e81c625b11c75
</html>