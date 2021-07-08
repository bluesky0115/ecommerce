<template>
  <div>
  <div class="flex">
    <a v-for="category in categories" :key="category.id" :href="k"></a>
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