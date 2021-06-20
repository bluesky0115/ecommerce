<template>
   <div class="flex p-2 bg-white">
   <div v-for="product in products " :key="product.id" class="m-2">
    <a :href="'/product/show/'+product.id">
     <img :src="'/storage/products/'+product.cover" alt="" class="w-48">
     <p>{{product.name}} {{product.price}} birr</p>
     <p>{{product.description}}</p>
     <div class="flex">
      <span>{{product.totalComments}} comments</span>
      <addtocart-component product-id="product.id" user-id="userId" />
      <report-component user-id="userId" product-id="productId"></report-component>
     </div> 
    </a>
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