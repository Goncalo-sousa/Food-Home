<template>
  <div>
    <div class="navbar-item has-dropdown is-hoverable">
      <a> Cart ({{ $store.state.cartCount }}) </a>

      <div
        v-if="$store.state.cart.length > 0"
        class="navbar-dropdown is-boxed is-right"
      >
        <a v-for="item in $store.state.cart" :key="item.id">
          {{ item.name }} x{{ item.quantity }}
          <span
            class="removeBtn"
            title="Remove from cart"
            @click.prevent="removeFromCart(item)"
          >
            X</span
          ><br />
          {{ item.price }}€ <br />
        </a>
        <hr class="navbar-divider" />
        <a> Total: {{ totalPrice }}€ </a>

        <hr class="navbar-divider" />

        <!-- <a class="navbar-item">Checkout</a> -->
        <button class="btn btn-primary" @click.prevent="createOrder(totalPrice)">
          Checkout
        </button>
      </div>

      <div v-else class="navbar-dropdown is-boxed is-right">
        <a> Cart is empty </a>
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
        totalPrice += parseFloat(item.price * item.quantity);
      }
      console.log(totalPrice);
      return parseFloat(totalPrice).toFixed(2);
    },
    user: function () {
      console.log(this.$store.state.user);
      return this.$store.state.user ? this.$store.state.user : null;
    },
    
  },
  methods: {
    removeFromCart(item) {
      this.$store.commit("removeFromCart", item);
    },
    createOrder: function (totalPrice) {
      let data={
        status: 'H',
        customer_id: null,
        notes: null,
        total_price: null,
        date: null,
        prepared_by: null,
        delivered_by: null,
        opened_at: null,
        current_status_at: null,
        closed_at: null,
        preparation_time: null,
        created_at: null,
        updated_at: null,
      };
      data.customer_id = this.$store.state.user.id;
      data.total_price = totalPrice;
      data.date = Date.now();
      data.opened_at=Date.now();
      data.created_at=Date.now();
      console.log(data);
      axios.post(`/api/orders/`, data).then((result) => {
        const order = result.data;
        console.log(order);
      });
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