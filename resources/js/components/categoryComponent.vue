<template>
   <div>
    <div v-for="product in products " :key="product.id">
     <img :src="product.imageSource" alt="" class="">
     <p>{{product.name}} {{product.price}} birr</p>
     <p>{{product.description}}</p>
     <div>
       <span>{{product.totalComments}} comments</span>
       <a :href="'product/show'+product.id">details</a>
       <report-component user-id="userId" product-id="productId"></report-component>
     </div>
    </div>
   </div>
</template>
<script>
export default {
  data(){
    return{
      products:[],
      categoryId:null
    }
  },
  mounted(){
    this.categoryId=$route.params.categoryId;
    axios.get('/category/product',{params:{categoryId:this.categoryId}})
    .then(res=>{
      this.products=res.data.products;
      console.log(this.categoryId);
      console.log(this.products);
    })
  }
}
</script>