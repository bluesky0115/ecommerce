<template>
  <div class="flex">
   <div v-for="product in products " :key="product.id" class="bg-gray-100 m-2 p-2">
    <img :src="'/storage/products/'+product.cover" alt="" class="">
    <p>{{product.name}} {{product.price}} birr</p>
    <p>{{product.description}}</p>
    <div class="flex">
      <span>{{product.totalComments}} comments</span>
      <a :href="'/product/show/'+product.id">details</a>
      <addtocart-component product-id="product.id" user-id="userId" />
      <report-component user-id="userId" product-id="productId"></report-component>
    </div>
   </div>
  </div>     
</template>
<script>
export default {
  props:['userId'],
  data(){
    return{
      products:[], 
     }     
  },
  mounted(){
   axios.get('/products')
   .then(res=>{
     this.products=res.data.products;
   })
   .catch(err=>{

   });
  },
  methods:{

  }     
}
</script>