<template>
  <div>
    <div class="navbar-item has-dropdown is-hoverable">
      <a class="navbar-link"> Cart ({{ $store.state.cartCount }}) </a>

      <div
        v-if="$store.state.cart.length > 0"
        class="navbar-dropdown is-boxed is-right"
      >
        <a v-for="item in $store.state.cart" :key="item.id" class="navbar-item">
          {{ item.name }} x{{ item.quantity }} <br />
          {{ item.price }}€ <br />
        </a>
        <hr class="navbar-divider" />
        <a class="navbar-item"> Total: {{ totalPrice }}€ </a>

        <hr class="navbar-divider" />

        <a class="navbar-item"> Checkout </a>
      </div>

      <div v-else class="navbar-dropdown is-boxed is-right">
        <a class="navbar-item"> Cart is empty </a>
      </div>
    </div>
  </div>
</template>

<script>
import store from "vuex";
export default {
  computed: {
    totalPrice: function () {
      let totalPrice = 0;

      for (let item of this.$store.state.cart) {
        totalPrice = +item.price * item.quantity;
        console.log(item.price);
        console.log(item.name);
      }
      console.log(totalPrice);
      return parseFloat(totalPrice).toFixed(2);
    },
  },
  methods: {
    removeFromCart(item) {
      this.$store.commit("removeFromCart", item);
    },
  },
};
</script>

<style>
.removeBtn {
  margin-right: 1rem;
  color: red;
}
</style>