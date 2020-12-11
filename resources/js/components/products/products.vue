<template>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Photo</th>
        <th>Price</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="product of products" :key="product.id">
        <th>{{ product.name }}</th>
        <th>{{ product.type }}</th>
        <th><img v-bind:src="'storage/products/'+product.photo_url" width="50vw" height="50vh"></th>
        <th>{{ product.price }}€</th>
        <th>{{ product.description }}</th>
        <td>
          <button class="btn btn-primary" v-on:click="editProduct(product)">
            Edit
          </button>
          <button class="btn btn-danger" @click="deleteProduct(product)">
            Delete
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: ["products"],
  methods: {
    editProduct(product) {
      this.$router.push({ path: `/products/${products.id}` });
    },
    deleteProducts(product) {
      this.$emit("delete-product", product);
    },
  },
};
</script>

<style>
</style>