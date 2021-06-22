<template>
  <div>
  <div class="flex">
    <router-link v-for="category in categories" :to="{name:'category', params:{categoryId:category.id,category:category.name}}" :key="category.id" 
    class="text-gray-800 capitalize text-2xl my-1 mx-3 active:border-bottom-2 active:border-gray-600">
       {{category.name}}
    </router-link>
  </div>
  </div>
</template>
<script>
export default {
  data(){
    return{
     categories:[]
    }
  },
  mounted(){
    axios.get('/categories')
    .then(res=>{
      this.categories=res.data.categories;
    })
  }
}
</script>