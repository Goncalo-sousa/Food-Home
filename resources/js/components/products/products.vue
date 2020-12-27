<template>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Price</th>
        <th>Description</th>
        <th>Photo</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="product of products" :key="product.id">
        <th v-if="product.deleted_at == null">{{ product.name }}</th>
        <th v-if="product.deleted_at == null">{{ product.type }}</th>
        <th v-if="product.deleted_at == null">{{ product.price }}€</th>
        <th v-if="product.deleted_at == null">{{ product.description }}</th>
        <th v-if="product.deleted_at == null">
          <img
            v-bind:src="'storage/products/' + product.photo_url"
            width="50vw"
            height="50vh"
          />
        </th>
        <td v-if="product.deleted_at == null">
          <button class="btn btn-primary" v-on:click="editProduct(product)">
            Buy
          </button>
        </td>
        <th></th>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  data() {
    return {
      products: [],
    };
  },
  methods: {
    editProduct(product) {
      this.$router.push({ path: `/products/${products.id}` });
    },
    deleteProducts(product) {
      // this.$emit("delete-product", product);
    },
  },
  mounted() {
    axios.get("/api/products").then((response) => {
      this.products = response.data.data;
    });
  },
};
</script>

<style>
</style>