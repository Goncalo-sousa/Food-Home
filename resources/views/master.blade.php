<!DOCTYPE html>
<html lan g="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">
    <title>@yield('title')</title>
    
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    @yield('extrastyles')
</head>

<style>
body {font-family: "Times New Roman", Georgia, Serif;}
h1, h2, h3, h4, h5, h6 {
  font-family: "Playfair Display";
  letter-spacing: 5px;
}
</style>

<body >
  <div id="app">
   </div>

   
   
  
  </div>
  



    <div class="container">
        @yield('content')
    </div>
    @yield('pagescript')
 </div>




<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Trabalho realizado em âmbito da UC desenvolvimento de aplicações distribuidas <a href="" target="_blank" class="w3-hover-text-green"></a></p>
</footer>


</body>

<script src="{{ mix('js/app.js') }}"></script>
</html>