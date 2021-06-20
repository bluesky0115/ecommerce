<template>
  <div>
  <div>
    <router-link v-for="category in categories" :to="{name:'product', params:{categoryId:category.id,category:category.name}}" :key="category.id">
       {{category.name}}
    </router-link>
  </div>
  </div>
</template>
<script>
export default {
  data(){
    return{
     catagories:[]
    }
  },
  mounted(){
    axios.get('/catagories')
    .then(res=>{
      this.catagories=res.data.catagories;
    })
  }
}
</script>