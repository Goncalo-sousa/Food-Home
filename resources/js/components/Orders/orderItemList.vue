<template>
  <div>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Photo</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Total Price</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="orderitem of orderItems" :key="orderitem.id">
          <td>{{ orderitem.id }}</td>
          <td>{{ orderitem.product.name }}</td>
          <td>{{ orderitem.product.type }}</td>
          <td>
            <img
              width="75px"
              height="75px"
              :src="'/storage/products/' + orderitem.product.photo_url"
            />
          </td>
          <td>{{ orderitem.quantity }}</td>
          <td>{{ orderitem.unit_price }}€</td>
          <td>{{ orderitem.sub_total_price }}€</td>
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
