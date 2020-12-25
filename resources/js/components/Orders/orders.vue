<template>
  <div>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Type</th>
          <th>Blocked</th>
          <th>Photo</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order of orders" :key="order.id">
          <td>{{ order.customer_id }}</td>
          <td>{{ order.status }}</td>
          <td>{{ order.total_price }}€</td>
          <td>{{ order.date }}</td>
          <td>{{ order.prepared_by }}</td>
          <td>{{ order.delivered_by }}</td>
        </tr>
      </tbody>
    </table>
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

<style>
</style>