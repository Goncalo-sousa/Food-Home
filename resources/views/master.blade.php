<!DOCTYPE html>
<html lan g="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
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
          <router-link v-if="$store.state.user && $store.state.user.type == 'EM'" class="w3-bar-item w3-button" to="/management">Manage</router-link>
        
          <router-link v-show="$route.path==='/'" class="w3-bar-item w3-button" to="/products">Products</router-link>
         
          <router-link v-if="!$store.state.user" class="w3-bar-item w3-button" to="/register">Register</router-link>
          <router-link v-if="!$store.state.user" class="w3-bar-item w3-button" to="/login">Login</router-link>
          <button v-if="$store.state.user" @click.prevent="LogOut" class="w3-bar-item w3-button">Logout</button>
        </div>


      </div>
    </div>

   

    <div style="padding-top: 5rem">
      <router-view></router-view>
      <img src="{{ URL::asset('home/menu.jpg') }}" class="center" alt="Menu" style="width:40%" >
    </div>

  </div>

  <script src="{{ mix('js/app.js') }}"></script>

</body>

<!-- Footer 
<footer class="w3-center w3-light-grey w3-padding-32">
<p>Trabalho realizado em âmbito da UC desenvolvimento de aplicações distribuidas <a href="" target="_blank" class="w3-hover-text-green"></a></p>
</footer>
-->

</html>