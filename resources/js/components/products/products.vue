<template>
<Card title="List od products">



    <div class="row">
        <div class="col-md-2"></div>
        <label for="productType">Type: </label>
        <select id="productType" v-model="search.type">
        <option value="">All</option>
        <option value="hot dish">Hot dish:</option>
        <option value="cold dish">Cold dish:</option>
        <option value="drink">Drink:</option>
        <option value="dessert">Dessert:</option>
       </select>
        
        </div>
         <span>{{search}}</span>
 
  <div class="row">
        <div class="col-md-2"></div>
        <div class="form-group">
            <label value="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" />
          <button  type="submit" class="btn btn-primary" v-on:click="getProducts()">Search</button>

        </div>
    </div>
    
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

</Card>
</template>

<script>
export default {
  data() {
    return {
      products: [],
      search: {
        name: "",
        type: "",
      },
      checkedNames: [],
    };
  },
  methods: {
    
    editProduct(product) {
      this.$router.push({ path: `/products/${products.id}` });
    },
    deleteProducts(product) {
      // this.$emit("delete-product", product);
    },
     getProducts: function() {
      axios
        .post("/api/products/filter", this.search)
        .then(response => {
          if (response.data == "Can't search by category!") {
            this.showError = true;
            this.errorMessage = response.data;
          } else {
            this.products = response.data;
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    send() {
      let obj = {
        check_items: this.checkedNames
      }
      this.axios.post('api/products/filter', obj)
          .then(res => console.log(res.data));
    },

    getResults: function() {
      axios
        .post("api/products/filter?page=" + page, this.search)
        .then(response => {
          this.products = response.data;
        });
    }
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