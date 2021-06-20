<template>
  <div>
  <div class="flex overflow-scroll mx-2">
    <router-link to="/all">all</router-link>
    <router-link v-for="category in categories" :to="{name:'product', params:{categoryId:category.id,category:category.name}}" :key="category.id">
       {{category.name}}
    </router-link>
    <router-link to="/other">other</router-link>
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
      console.log('categories '+this.categories);
    })
  }
}
</script>