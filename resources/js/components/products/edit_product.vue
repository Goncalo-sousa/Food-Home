<template >
   <div class="jumbotron">
         <h2>Edit Product</h2>

           <form v-if="product"> 
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" v-model="product.name">
                </div>

                <div class="form-group">
                    <label>Type</label>
                    <input type="text" class="form-control" v-model="product.type">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" v-model="product.description">
                </div>

                <div class="form-group">
                    <label>Foto</label>
                    <input type="text" class="form-control" v-model="product.photo_url">
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" v-model="product.price">
                </div>


                <div class="form-group">
                <button class="btn btn-primary" @click.prevent="saveProduct()">Save</Button>
                        <button class="btn btn-secondary" v-on:click="cancelEdit()">Cancel</Button>    
                </div>
         
             </form>
       
         </div>
</template>

<script>
export default {
props: ["product"],
  data: function () {
    return {};
  },
  methods: {
    saveProduct() {
      //this.$emit("save-user", this.user);
      //this.$router.push({path: `/users`, params:{'save-user': this.user}});
    },
    cancelEdit() {
      // this.$emit("cancel-edit");
      //this.$router.push({ path: "/management" });
    },
  },
  async created() {
    const productID = this.$route.params.id;
    this.product = (await axios.get(`/api/products/${productID}`)).data.data;
  },

}
</script>

<style>

</style>