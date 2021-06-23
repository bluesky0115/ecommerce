<template>
  <div>
  <div class="flex">
    <router-link to='/products/all' class="text-gray-800 capitalize text-2xl my-1 mx-3 active:border-bottom-2 active:border-gray-600">
      all
    </router-link>
    <router-link v-for="category in categories" :to="{name:'category',params:{categoryName:category.name,categoryId:category.id}}" :key="category.id" 
    class="text-gray-800 capitalize text-2xl my-1 mx-3 active:border-bottom-2 active:border-gray-600">
       {{category.name}}
    </router-link>
  </div>
  <router-view></router-view>
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