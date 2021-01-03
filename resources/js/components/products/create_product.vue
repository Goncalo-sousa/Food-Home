<template >
  <div class="jumbotron">
    <h2>Create Product</h2>

    <form>
      <label for="name">Name</label>
      <input
        required
        type="text"
        v-model="product.name"
        id="name"
        placeholder="Name"
      />

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
        <br />
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
        </form>
      </div>

      <div class="form-group">
        <label>Price</label>
        <input type="number" class="form-control" v-model="product.price" />
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
    return {
      product: {
        name: "",
        type: "",
        description: "",
        photo_url: null,
        price: "",
      },
    };
  },
  methods: {
    saveProduct: function () {
      console.log(this.product);
      axios
        .post("/api/products/create", this.product)
        .then((result) => {
          this.$router.push({ name: "products" });
        })
        .catch((errors) => {
          if (errors.response.status === 422) {
            this.errors.record(errors.response.data.errors, "");
          }
        });
    },
    cancelEdit() {
      this.$router.push({ path: "/products" });
    },
    fileSelected: function (event) {
      this.selectedFile = event.target.files[0];
      const fd = new FormData();
      fd.append("photo_url", this.selectedFile);
      this.product.photo_url = this.selectedFile.name;
      console.log(this.selectedFile);
    },
  },
};
</script>

<style>
</style>