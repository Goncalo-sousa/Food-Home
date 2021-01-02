<template >
  <div class="jumbotron">
    <h2>Edit Product</h2>

    <form v-if="product">
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" v-model="product.name" />
      </div>

      <div class="form-group">
        <label>Type:</label>
        <select class="form-control" v-model="product.type">
          <option disabled value="">Please select one</option>
          <option value="drink">Drink</option>
          <option value="cold dish">Cold dish</option>
          <option value="hot dish">Hot dish</option>
          <option value="dessert">Dessert</option>
        </select>
      </div>

      <div class="form-group">
        <label>Description</label>
        <input type="text" class="form-control" v-model="product.description" />
      </div>

      <div class="form-group">
        <label>Foto</label>
        <br>
        <img
          v-bind:src="'storage/products/' + product.photo_url"
          width="150px"
          height="150px"
        />
        <form enctype="multipart/form-data">
          <br />
          <input
            style="display: none"
            type="file"
            accept="image/*"
            @change="fileSelected"
            ref="fileInput"
          />
          <button
            class="btn btn-primary"
            @click.prevent="$refs.fileInput.click()"
          >
            Upload Image
          </button>
          <button class="btn btn-primary" @click.prevent="updateImage()">
            Save
          </button>
        </form>
      </div>

      <div class="form-group">
        <label>Price</label>
        <input type="text" class="form-control" v-model="product.price" />
      </div>

      <div class="form-group">
        <button class="btn btn-primary" @click.prevent="saveProduct()">
          Save
        </button>
        <button class="btn btn-secondary" v-on:click="cancelEdit()">
          Cancel
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data: function () {
    return { product: undefined };
  },
  methods: {
    saveProduct: function () {
      console.log(this.product);
      axios
        .put(`/api/products/${this.product.id}`, this.product)
        .then((result) => {
          const product = result.data.data;

          Object.assign(this.product, product);
        });
    },
    cancelEdit() {
      this.$router.push({ path: "/products" });
    },
    fileSelected: function (event) {
      this.selectedFile = event.target.files[0];
      console.log(this.selectedFile);
    },
    updateImage: function () {
      const fd = new FormData();
      fd.append("photo_url", this.selectedFile);
      console.log(fd);
      axios.post(`/api/products/changeimage/${this.product.id}`, fd).then((result) => {
        console.log(result);
      });
    },
  },
  async created() {
    const productID = this.$route.params.id;
    this.product = (await axios.get(`/api/products/${productID}`)).data.data;
  },
};
</script>

<style>
</style>