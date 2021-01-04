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
 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  

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
        <span v-if="$store.state.user">@{{$store.state.user.name}}</span>
        <span v-if="$store.state.user">@{{$store.state.user.type}}</span>
        <!-- Right-sided navbar links. Hide them on small screens -->
        <div class="w3-right w3-hide-small">
          <router-link v-if="$store.state.user && $store.state.user.type == 'EM'" class="w3-bar-item w3-button" to="/manageUsers">Manage Users</router-link>
          <router-link v-if="$store.state.user && $store.state.user.type == 'EM'" class="w3-bar-item w3-button" to="/manageOrders">Manage Orders</router-link>
          <router-link class="w3-bar-item w3-button" to="/products">Products</router-link>
          <!-- <router-link v-show="$route.path==='/'" class="w3-bar-item w3-button" to="/products">Products</router-link> -->
         
          <router-link v-if="$store.state.user && $store.state.user.type == 'C'" class="w3-bar-item w3-button" to="/cart">Cart (@{{$store.state.cartCount}})</router-link>
          <router-link v-if="!$store.state.user" class="w3-bar-item w3-button" to="/register">Register</router-link>
          <router-link v-if="!$store.state.user" class="w3-bar-item w3-button" to="/login">Login</router-link>
          <router-link v-if="$store.state.user && $store.state.user.type == 'EC'" class="w3-bar-item w3-button" to="/cookDashboard">Cook Dashboard</router-link>
          <router-link v-if="$store.state.user && $store.state.user.type == 'ED'" class="w3-bar-item w3-button" to="/deliverymanDashboard">Delveryman Dashboard</router-link>
          <router-link v-if="$store.state.user && $store.state.user.type == 'C'" class="w3-bar-item w3-button" to="/myOrders">My Orders</router-link>
          
          <router-link v-if="$store.state.user"  class="w3-bar-item w3-button" to="/myprofile">My Profile</router-link>
          <button v-if="$store.state.user" @click.prevent="LogOut" class="w3-bar-item w3-button">Logout</button>
        </div>


      </div>
    </div>

   

    <div class="container" style="padding-top: 5rem">
      <router-view></router-view>
    </div>

  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="{{ mix('js/app.js') }}"></script>

  

</body>

<!-- Footer 
<footer class="w3-center w3-light-grey w3-padding-32">
<p>Trabalho realizado em âmbito da UC desenvolvimento de aplicações distribuidas <a href="" target="_blank" class="w3-hover-text-green"></a></p>
</footer>
-->

</html>