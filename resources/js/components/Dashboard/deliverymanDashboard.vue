<template>
  <div>
    <h2 v-if="user && user.type === 'ED'">Deliveryman Dashboard</h2>
    <table v-if="orders.length" class="table">
      <thead class="thead-dark">
        <tr>
          <th>Order ID</th>
          <th>Status</th>
          <th>Opened At</th>
          <th>Time Elapsed</th>
          <th>Address</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Customer</th>
          <th>Order Items</th>
          <th>Notes</th>
          <th>Pick Order</th>
          <th>Order Completed</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order of orders" :key="order.id">
          <td>{{ order.id }}</td>
          <td>{{ order.status }}</td>
          <td>{{ order.opened_at }}</td>
          <td>{{ order.preparation_time }}</td>
          <td>{{ order.address }}</td>
          <td>{{ order.phone }}</td>
          <td>{{ order.email }}</td>
          <td>{{ order.customer.name }}</td>
          <td>{{ order.order_items }}</td>
          <td>{{ order.notes }}</td>
          <td>
            <button v-on:click.prevent="pickUpOrder(order)">Pick Up</button>
          </td>
          <td>
            <button v-on:click.prevent="changeOrderStatus(order)">Done</button>
          </td>
        </tr>
      </tbody>
    </table>
    <div v-else>
      <h5>No orders</h5>
    </div>
  </div>
</template>

<script>
export default {
  //props: ["user"],
  computed: {
    user: function () {
      console.log(this.$store.state.user);
      return this.$store.state.user ? this.$store.state.user : null;
    },
  },
  data() {
    return {
      orders: [],
    };
  },
  methods: {
    changeOrderStatus: function (order) {
      this.currentOrder = order;
      this.currentOrder.status = "D";
      console.log(this.currentOrder.status);
      axios
        .put("api/orders/" + this.currentOrder.id, this.currentOrder)
        .then((response) => {
          this.showSuccess = true;
          this.successMessage = "Order Status Changed";
          Object.assign(this.currentOrder, response.data.data);
        });
    },
    pickUpOrder: function (order) {
      this.currentOrder = order;
      this.currentOrder.status = "T";
      console.log(this.currentOrder.status);
      axios
        .put("api/orders/" + this.currentOrder.id, this.currentOrder)
        .then((response) => {
          this.showSuccess = true;
          this.successMessage = "Order Status Changed";
          Object.assign(this.currentOrder, response.data.data);
        });
    },
  },
  mounted() {
    axios.get("/api/orders").then((response) => {
      this.orders = response.data.data;
    });
  },
};
</script>

<style></style>
