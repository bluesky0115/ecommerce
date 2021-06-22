<template>
   <div>
     <p>category component</p>
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
  props:['categoryId'],
  data(){
    return{
      products:[]
    }
  },
  mounted(){
    axios.get('/category/product',{params:{categoryId:this.categoryId}})
    .then(res=>{
      this.products=res.data.products;
    })
  }
}
</script>