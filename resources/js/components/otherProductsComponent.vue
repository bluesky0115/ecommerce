<template>
  <div>
   <div v-for="product in products " :key="product.id">
    <img :src="product.imageSource" alt="" class="">
    <p>{{product.name}} {{product.price}} birr</p>
    <p>{{product.description}}</p>
    <span>{{product.totalComments}} comments</span>
    <a href="'product/show'+product.id">details</a>
    <report-component user-id="userId" product-id="productId"></report-component>
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