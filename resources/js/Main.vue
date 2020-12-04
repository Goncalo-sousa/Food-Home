<template>
  <div>
      <div class="jumbotron">
         <h1></h1>
        </div>
          <!-- <products :products="products" @edit-product="editProduct" @delete-product="deleteProduct"></products> -->


         <div class="alert" v-if="successMessage || failMessage" :class="{'alert-success':successMessage, 'alert-danger':failMessage}" @click="closeMessage" >
          <button type="button" class="close-btn" >&times;</button>
           <strong>{{successMessage || failMessage}}</strong>
        </div>

        <edit-product  v-if="editingProduct" :product="currentProd"  @cancel-edit="cancelEdit" @save-product="saveProduct"></edit-product>
        
    </div>

  
</template>

<script>

import EditProductComponent from './components/edit_product.vue'
import Products from './components/products.vue'

export default {
    data:function(){
        return{
        title: 'List Products',
        editingProduct:  false,
        showSuccess: false,
        showFailure: false,
        successMessage: '',
        failMessage: '',
        currentProduct: {},
        products: [],
        }
       
    },
    methods: {
        editProduct: function (product) {
            this.currentProduct = Object.assign({},product)
            this.editProduct = true

        },
        deleteUser: function (product) {
           
            axios.delete(`/api/products/${product.id}`).then(result=>
            {})
            this.products.splice(this.products.findIndex(u=>u.id == product.id),1)

        },
        saveUser: function (product) {
            Object.assign(this.currentProduct, product)
            axios.put(`/api/products/${this.currentProduct.id}`,this.currentProduct)
            .then(result=>{
                const user = result.data.data
                Object.assign(this.products.find(u=>u.id == product.id),product)
                this.successMessage = 'Product updated!!!'
                this.failMessage = ''

            })
            .catch(reason=>{
                this.failMessage = 'Failed to edit product!!!'
                this.successMessage = ''
            })
            

        },
        cancelEdit: function () {
            this.failMessage = {}
            this.editingProduct = false


        },
        closeMessage: function(){
            this.successMessage = ''
            this.failMessage = ''

        }
    },
    mounted () {

        axios.get('/api/products')
        .then(response=>{
            this.products = response.data.data

        })

    },
    components:{
        'edit-product':EditProductComponent
        
    }
}
</script>

<style>

</style>