<template>
  <div>
    <h2 v-if="user && user.type === 'C'">My Orders</h2>
    <button
      class="btn btn-primary my-3"
      v-if="activeOrders"
      v-on:click.prevent="showOrderHistory()"
    >
      Order History
    </button>
    <button
      class="btn btn-primary my-3"
      v-if="!activeOrders"
      v-on:click.prevent="showActiveOrders()"
    >
      Active Orders
    </button>
    <div v-if="orderList.length">
      <table class="table table-responsive table-striped">
        <thead class="thead-dark">
          <tr>
            <th>Order ID</th>
            <th>Status</th>
            <th>Opened At</th>
            <th>Time Elapsed</th>
            <th>Order Items</th>
            <th>Prepared By</th>
            <th>Notes</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order of orderList" :key="order.id">
            <td>{{ order.id }}</td>
            <td>{{ order.status }}</td>
            <td>{{ order.opened_at }}</td>
            <td>{{ preparationTime(order) }}</td>
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
            <td>{{ order.cook ? order.cook.name : "N/A" }}</td>
            <td>{{ getOrderNotes(order) }}</td>
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
      console.log(this.$store.state.user);
      return this.$store.state.user ? this.$store.state.user : null;
    },
  },
  data() {
    return {
      orders: [],
      showActiveOrderItems: false,
      activeOrders: true,
      orderList: [],
      activeOrderItems: [],
      activeIndexId: -1,
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
    showOrderHistory: function () {
      this.activeOrders = false;
      this.orderList = [];
      this.orders.forEach((order) => {
        if (order.status == "Delivered") {
          this.orderList.push(order);
        }
      });
    },
    showActiveOrders: function () {
      this.activeOrders = true;
      this.orderList = [];
      this.orders.forEach((order) => {
        if (order.status != "Delivered") {
          this.orderList.push(order);
        }
      });
    },
    preparationTime: function (order) {
      let orderCreationTime = moment(order.opened_at);
      return orderCreationTime.fromNow();
    },
  },
  mounted() {
    axios.get("/api/orders").then((response) => {
      this.orders = response.data.data;
      this.showActiveOrders();
    });
  },
};
</script>

<style></style>
