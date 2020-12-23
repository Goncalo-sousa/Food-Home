<template>
 
</template>

<script>
import EditProductComponent from "./components/products/edit_product.vue";
import Products from "./components/products/products.vue";

export default {
  data: function () {
    return {
      title: "List Products",
      editingProduct: false,
      showSuccess: false,
      showFailure: false,
      successMessage: "",
      failMessage: "",
      currentProduct: {},
      products: [],
    };
  },
  methods: {
    editProduct: function (product) {
      this.currentProduct = Object.assign({}, product);
      this.editProduct = true;
    },
    deleteUser: function (product) {
      axios.delete(`/api/products/${product.id}`).then((result) => {});
      this.products.splice(
        this.products.findIndex((u) => u.id == product.id),
        1
      );
    },
    saveUser: function (product) {
      Object.assign(this.currentProduct, product);
      axios
        .put(`/api/products/${this.currentProduct.id}`, this.currentProduct)
        .then((result) => {
          const user = result.data.data;
          Object.assign(
            this.products.find((u) => u.id == product.id),
            product
          );
          this.successMessage = "Product updated!!!";
          this.failMessage = "";
        })
        .catch((reason) => {
          this.failMessage = "Failed to edit product!!!";
          this.successMessage = "";
        });
    },
    cancelEdit: function () {
      this.failMessage = {};
      this.editingProduct = false;
    },
    closeMessage: function () {
      this.successMessage = "";
      this.failMessage = "";
    },
  },

  components: {
    "edit-product": EditProductComponent,
  },
};
</script>

<style>
</style>