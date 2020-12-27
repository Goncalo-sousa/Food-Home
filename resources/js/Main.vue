<template>

<div>
<h1>Welcome to FOOD@HOME!!</h1>
<br> <br>
<h2>Start buying by <router-link v-if="!$store.state.user" class="w3-bar-item w3-button" to="/login">login</router-link> or <router-link v-if="!$store.state.user" class="w3-bar-item w3-button" to="/register">register</router-link> now!</h2>
      
      
</div>
 
</template>

<script>

</script>

<style>

h1 {text-align: center;}
h2 {text-align: center;}
</style>