<template>
  <div>
    <div class="navbar-item has-dropdown is-hoverable" style="texte-align: center">
      <div v-if="$store.state.cart.length > 0" class="navbar-dropdown is-boxed is-right">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Name</th>
              <th>Type</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Total Price</th>
              <th>Remove from Cart</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in $store.state.cart" :key="item.id">
              <td>
                {{ item.name }}
              </td>
              <td>{{ item.type }}</td>
              <td>{{ item.quantity }}</td>
              <td>{{ item.price }}€</td>
              <td>{{ calculateSubTotalPrice(item) }}€</td>
              <td>
                <span
                  class="removeBtn"
                  title="Remove from cart"
                  @click.prevent="removeFromCart(item)"
                >
                  X</span
                >
              </td>
            </tr>
          </tbody>
        </table>
        <hr class="navbar-divider" />
        <a> Total: {{ totalPrice }}€ </a>

        <hr class="navbar-divider" />

        <!-- <a class="navbar-item">Checkout</a> -->
        <button class="btn btn-primary" @click.prevent="createOrder()">Checkout</button>
      </div>

      <div style="text-align: center" v-else class="navbar-dropdown is-boxed is-right">
        <h2>Cart is empty</h2>
        <br />
        <button v-on:click.prevent="redirectProducts()" class="btn btn-primary">
          Start Buying Now!
        </button>
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
      console.log(this.item);
      return this.$store.state.user ? this.$store.state.user : null;
    },
  },
  methods: {
    removeFromCart(item) {
      this.$store.commit("removeFromCart", item);
    },
    createOrder: function (totalPrice) {
      let data = {
        products: this.$store.state.cart.map((product) => {
          return {
            id: product.id,
            quantity: product.quantity,
          };
        }),
      };
      axios.post("/api/orders", data, this.user).then((result) => {
        const order = result.data;
        this.$store.commit("clearCart");
        this.$router.push({ path: "/myOrders" });
      });
    },
    redirectProducts: function () {
      this.$router.push({ path: "/products" });
    },
    calculateSubTotalPrice: function (item) {
      return parseFloat(item.quantity * item.price).toFixed(2);
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
