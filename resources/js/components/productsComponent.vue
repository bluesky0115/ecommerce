<template>
   <div class="flex p-2">
   <div v-for="product in products " :key="product.id" class="rounded-xl m-2 hover:border-2 hover:border-primary hover:shadow-md">
    <a :href="'/product/show/'+product.id">
     <img :src="'/storage/products/'+product.cover" alt="" class="w-48">
     <p>{{product.name}} {{product.price}} birr</p>
     <p>{{product.description}}</p>
     <div class="flex">
      <span>{{product.totalComments}} comments</span>
      <addtocart-component :productId="product.id" :userId="userId" />
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
   });
  },
  methods:{

  }     
}
</script>