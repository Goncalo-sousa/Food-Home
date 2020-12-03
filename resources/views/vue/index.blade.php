@extends('master')

@section('title', 'Food@Home')

@section('extrastyles')
<header class="w3-display-container w3-content w3-wide" style="max-width:600px;min-width:300px" id="home">
  <img class="w3-image" src="{{ URL::asset('home/hamburger.jpg') }}" alt="Hamburger Catering" width="1600" height="800">
  <div class="w3-display-bottomleft w3-padding-large w3-opacity">
    <h1 class="w3-xxlarge">Food@Home</h1>
  </div>
</header>

@section('content')

<router-link to="/">Main</router-link>
<router-link to="/products">Menu </router-link>
<router-view></router-view>

@endsection
@section('pagescript')
<script src="js/app.js"></script>
@stop