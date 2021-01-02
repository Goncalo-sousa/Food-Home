<template>
  <div>
    <h2 v-if="user && user.type === 'ED'">Deliveryman Dashboard</h2>
    <div v-if="orderList.length">
      <table class="table table-responsive table-striped">
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
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order of orderList" :key="order.id">
            <td>{{ order.id }}</td>
            <td>{{ order.status }}</td>
            <td>{{ order.opened_at }}</td>
            <td>{{ preparationTime(order) }}</td>
            <td>{{ order.customer.address }}</td>
            <td>{{ order.customer.phone }}</td>
            <td>{{ order.customer.email }}</td>
            <td>{{ order.customer.name }}</td>
            <td>
              <button
                class="btn btn-primary"
                v-if="!showActiveOrderItems"
                v-on:click.prevent="setActiveOrderItems(order)"
              >
                View Order Items
              </button>
              <button
                class="btn btn-primary"
                v-else-if="activeIndexId === order.id"
                v-on:click.prevent="resetActiveOrderItems()"
              >
                Hide Order Items
              </button>
            </td>
            <td>{{ getOrderNotes(order) }}</td>
            <td>
              <button
                class="btn btn-primary"
                v-if="order.status === 'Ready'"
                v-on:click.prevent="pickUpOrder(order)"
              >
                Pick Up
              </button>
              <button
                class="btn btn-primary"
                v-if="order.status === 'In Transit'"
                v-on:click.prevent="changeOrderStatus(order)"
              >
                Done
              </button>
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
import moment from "moment";
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
      activeIndexId: -1,
      orderNotes: String,
    };
  },
  methods: {
    changeOrderStatus: function (order) {
      this.currentOrder = order;
      this.currentOrder.status = "D";
      axios
        .put("api/orders/" + this.currentOrder.id, this.currentOrder)
        .then((response) => {
          this.showSuccess = true;
          this.successMessage = "Order Status Changed";
          Object.assign(this.currentOrder, response.data.data);
          this.getOrders();
        });
    },
    getOrders: function () {
      axios.get("/api/orders").then((response) => {
        this.orders = response.data.data;
      });
    },
    preparationTime: function (order) {
      let orderCreationTime = moment(order.opened_at);
      return orderCreationTime.fromNow();
    },
    pickUpOrder: function (order) {
      this.currentOrder = order;
      this.currentOrder.status = "T";
      axios
        .put("api/orders/" + this.currentOrder.id, this.currentOrder)
        .then((response) => {
          this.showSuccess = true;
          this.successMessage = "Order Status Changed";
          Object.assign(this.currentOrder, response.data.data);
          this.getOrders();
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
    getOrderNotes: function (order) {
      if (order.notes == null) order.notes = "No Notes";
      return order.notes;
    },
  },
  mounted() {
    this.getOrders();
  },
};
</script>

<style></style>
