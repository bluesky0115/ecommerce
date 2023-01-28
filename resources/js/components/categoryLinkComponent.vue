<template>
  <div>
  <div class="flex">
    <a v-for="category in categories" :key="category.id" :href="k"></a>
  </div>
  <router-view></router-view>
  </div>
</template>
<script setup>
let categories=$ref([])

onMounted(()=>{
    axios.get('/categories')
    .then(res=>{
      categories=res.data.categories;
    })
})
</script>
