<template>
   <div class="flex">
    <div v-for="product in products " :key="product.id">
     <a :href="'/product/show/'+product.id">
      <img :src="'/storage/products/'+product.cover" class="w-32">
      <p>{{product.name}} {{product.price}} birr</p>
      <p>{{product.description}}</p>
      <div>
       <span>{{product.totalComments}} comments</span>
       <a :href="'product/show'+product.id">details</a>
      </div>
     </a>
    </div>
   </div>
</template>
<script setup>
let products=$ref([])
let categoryId=$ref(null)

onMounted(()=>{
    categoryId=t$route.params.categoryId;
    axios.get('/category/product',{params:{categoryId:categoryId}})
    .then(res=>{
      products=res.data.products;
    })
})
</script>
