<!DOCTYPE html>
<html lan g="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
                <router-link v-if="!$store.state.user" class="w3-bar-item w3-button" to="/login">Login</router-link>
      </li>
      <li class="nav-item">
      <router-link v-if="!$store.state.user" class="w3-bar-item w3-button" to="/register">Register</router-link>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">           <button v-if="$store.state.user" @click.prevent="LogOut" class="w3-bar-item w3-button">Logout</button>
</a>

        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<!--
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <router-link class="w3-bar-item w3-button" to="/">Food@Home</router-link>
        <span v-if="$store.state.user">@{{$store.state.user.name}}</span>
        <span v-if="$store.state.user">@{{$store.state.user.type}}</span>
        
        <div class="w3-right w3-hide-small">
          <router-link v-if="$store.state.user && $store.state.user.type == 'EM'" class="w3-bar-item w3-button" to="/management">Manage</router-link>
          <router-link class="w3-bar-item w3-button" to="/products">Products</router-link>
          <!-- <router-link v-show="$route.path==='/'" class="w3-bar-item w3-button" to="/products">Products</router-link> -->
         
          <router-link class="w3-bar-item w3-button" to="/cart">Cart</router-link>
          <router-link v-if="!$store.state.user" class="w3-bar-item w3-button" to="/register">Register</router-link>
          <router-link v-if="!$store.state.user" class="w3-bar-item w3-button" to="/login">Login</router-link>
          <router-link v-if="$store.state.user && $store.state.user.type == 'EC'" class="w3-bar-item w3-button" to="/cookDashboard">Cook Dashboard</router-link>
          <router-link v-if="$store.state.user && $store.state.user.type == 'ED'" class="w3-bar-item w3-button" to="/deliverymanDashboard">Delveryman Dashboard</router-link>
          <router-link v-if="$store.state.user && $store.state.user.type == 'C'" class="w3-bar-item w3-button" to="/myOrders">My Orders</router-link>
          
          <router-link v-if="$store.state.user"  class="w3-bar-item w3-button" to="/myprofile">My Profile</router-link>
          <button v-if="$store.state.user" @click.prevent="LogOut" class="w3-bar-item w3-button">Logout</button>

        </div>


    </nav>
-->

   

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