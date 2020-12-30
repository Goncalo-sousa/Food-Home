<template>
  <div>
    <h2 v-if="user && user.type === 'EC'">Cook Dashboard</h2>
    <div v-if="orders.length">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>Order ID</th>
            <th>Status</th>
            <th>Opened At</th>
            <th>Time Elapsed</th>
            <th>Order Items</th>
            <th>Prepared By</th>
            <th>Customer</th>
            <th>Notes</th>
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
            <td>
              <button
                v-if="!showActiveOrderItems"
                v-on:click.prevent="setActiveOrderItems(order)"
              >
                View Order Items
              </button>
              <button
                v-else-if="activeIndexId === order.id"
                v-on:click.prevent="resetActiveOrderItems()"
              >
                Hide Order Items
              </button>
            </td>
            <td>{{ order.cook.name }}</td>
            <td>{{ order.customer.name }}</td>
            <td>{{ order.notes }}</td>
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
      console.log(this.$store.state.user);
      return this.$store.state.user ? this.$store.state.user : null;
    },
  },
  data() {
    return {
      orders: [],
      showActiveOrderItems: false,
      activeOrderItems: [],
      activeIndexId: -1,
    };
  },
  methods: {
    changeOrderStatus: function (order) {
      let form = { status: "D" };
      axios.put("api/orders/" + order.id, form).then((response) => {
        this.showSuccess = true;
        this.successMessage = "Order Status Changed";
        this.getOrders();
      });
    },
    getOrders: function () {
      axios.get("/api/orders").then((response) => {
        this.orders = response.data.data;
      });
    },
    getItemsName: function (orderItems) {
      return orderItems.map((orderItem) => orderItem.name);
    },
    setActiveOrderItems: function (order) {
      this.activeIndexId = order.id;
      this.activeOrderItems = order.order_items;
      this.showActiveOrderItems = true;
    },
    resetActiveOrderItems: function () {
      this.activeOrderItems = [];
      this.showActiveOrderItems = false;
    },
  },
  mounted() {
    this.getOrders();
  },
};
</script>

<style></style>
