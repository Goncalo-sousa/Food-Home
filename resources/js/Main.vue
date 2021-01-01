<template>
  <div>
    <h1>Welcome to FOOD@HOME!!</h1>
    <br />
    <br />
    <h2>
      Start buying
      <router-link
        v-if="!$store.state.user"
        class="w3-bar-item w3-button"
        to="/login"
        >by login</router-link
      >
      <router-link
        v-if="!$store.state.user"
        class="w3-bar-item w3-button"
        to="/register"
        >or register</router-link
      >
      <router-link
        v-if="$store.state.user"
        class="w3-bar-item w3-button"
        to="/products"
        >Products</router-link
      >
      now!
    </h2>
    <img
      class="center"
      alt="Menu"
      style="width: 40%"
      v-bind:src="'/home/menu.jpg'"
    />
  </div>
</template>

<script></script>

<style>
h1 {
  text-align: center;
}
h2 {
  text-align: center;
}
</style>
