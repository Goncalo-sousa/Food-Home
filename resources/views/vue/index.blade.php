@extends('master')

@section('title', 'Food@Home')

@section('content')

<router-link to="/">Main</router-link>
<router-view></router-view>

@endsection
@section('pagescript')
<script src="js/app.js"></script>
@stop