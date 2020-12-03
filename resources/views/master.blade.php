<!DOCTYPE html>
<html lan g="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
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
  <div id="app">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">

    <!-- Navbar (sit on top) -->
    <div class="w3-top">
      <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
        <a class="w3-bar-item w3-button">Food@Home</a>
        <div class="w3-right w3-hide-small">
          <router-link class="w3-bar-item w3-button" to="/register">Register</router-link>
        </div>
      </div>
    </div>

    <div class="container">
      @yield('content')
    </div>
    @yield('pagescript')
  </div>

  </div>
</body>

</html>