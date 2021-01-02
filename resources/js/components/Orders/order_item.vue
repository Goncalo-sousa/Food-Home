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
        <tr v-for="orderitem of orderitems" :key="orderitem.id">
          <td>{{ orderitem.order_id }}</td>
          <td>{{ orderitem.product_id }}</td>
          <td>{{ orderitem.unit_price }}€</td>
          <td>{{ orderitem.sub_total_price }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      orderitems: [],
    };
  },
  mounted() {
    axios.get("/api/orderitems").then((response) => {
      this.orderitems = response.data.data;
    });
  },
};
</script>

<style></style>
