<template>
  <div>
    <table v-if="orders.length" class="table">
      <thead class="thead-dark">
        <tr>
          <th>Order ID</th>
          <th>Status</th>
          <th>Opened At</th>
          <th>Prepared By</th>
          <th>Customer</th>
          <th>Notes</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order of orders" :key="order.id">
          <td>{{ order.id }}</td>
          <td>{{ order.status }}</td>
          <td>{{ order.opened_at }}</td>
          <td>{{ order.cook.name }}</td>
          <td>{{ order.customer.name }}</td>
          <td>{{ order.notes }}</td>
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
  data() {
    return {
      orders: [],
    };
  },
  mounted() {
    axios.get("/api/orders").then((response) => {
      this.orders = response.data.data;
    });
  },
};
</script>

<style></style>
