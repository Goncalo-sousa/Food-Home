<!DOCTYPE html>
<html lan g="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">

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
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
        <a class="w3-bar-item w3-button">Food@Home</a>
        <div class="w3-right w3-hide-small">
          <router-link class="w3-bar-item w3-button" to="/register">Register</router-link>
          <router-link class="w3-bar-item w3-button" to="/">Main</router-link>
          <router-link class="w3-bar-item w3-button" to="/products">Menu</router-link>
          <router-link class="w3-bar-item w3-button" to="/manageusers">Users</router-link>
        </div>
      </div>
    </div>
    @yield('content')
  </div>

  @yield('pagescript')
</body>

</html>