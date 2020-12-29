<template>
  <div>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="orderitem of orderItems" :key="orderitem.id">
          <td>{{ orderitem.id }}</td>
          <td>{{ orderitem.product.name }}</td>
          <td>{{ orderitem.quantity }}</td>
          <td>{{ orderitem.unit_price }}€</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    orderItems: {
      type: Array,
      required: false,
      default: () => [],
    },
  },
};
</script>

<style></style>
