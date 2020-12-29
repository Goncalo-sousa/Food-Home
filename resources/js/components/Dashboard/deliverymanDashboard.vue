<template>
  <div>
    <h2 v-if="user && user.type === 'ED'">Deliveryman Dashboard</h2>
    <div v-if="orderList.length">
      <table class="table">
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
          <tr v-for="order of orderList" :key="order.id">
            <td>{{ order.id }}</td>
            <td>{{ order.status }}</td>
            <td>{{ order.opened_at }}</td>
            <td>{{ order.preparation_time }}</td>
            <td>{{ order.address }}</td>
            <td>{{ order.phone }}</td>
            <td>{{ order.email }}</td>
            <td>{{ order.customer.name }}</td>
            <td>
              <button
                v-if="!showActiveOrderItems"
                v-on:click.prevent="setActiveOrderItems(order.order_items)"
              >
                View Order Items
              </button>
              <button v-else v-on:click.prevent="resetActiveOrderItems()">
                Hide Order Items
              </button>
            </td>
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
      <order-item-list
        v-if="showActiveOrderItems"
        :orderItems="activeOrderItems"
      ></order-item-list>
    </div>
    <div v-else>
      <h5>No orders</h5>
    </div>
  </div>
</template>

<script>
import OrderItemList from "../Orders/orderItemList.vue";
export default {
  components: {
    OrderItemList,
  },
  computed: {
    user: function () {
      return this.$store.state.user ? this.$store.state.user : null;
    },
    orderList: function () {
      const onTransitOrders = this.orders.filter((order) => order.status === "T");
      return onTransitOrders.length ? onTransitOrders : this.orders;
    },
  },
  data() {
    return {
      orders: [],
      showActiveOrderItems: false,
      activeOrderItems: [],
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
    getItemsName: function (orderItems) {
      return orderItems.map((orderItem) => orderItem.name);
    },
    setActiveOrderItems: function (orderItems) {
      this.activeOrderItems = orderItems;
      this.showActiveOrderItems = true;
    },
    resetActiveOrderItems: function () {
      this.activeOrderItems = [];
      this.showActiveOrderItems = false;
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
