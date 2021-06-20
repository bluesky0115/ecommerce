<template>
  <div>
   <router-link to="/">all</router-link>
   <router-link v-for="category in categories " :key="category.id" :to="category.id">
     {{category.name}}
   </router-link>
  </div>     
</template>
<script>
export default {
  props:[],
  data(){
    return{
      categories:[], 
     }     
  },
  mounted(){
   axios.get('/categories')
   .then(res=>{
     this.categories=res.data.categories;
   })
   .catch(err=>{

   });
  },
  methods:{

  }     
}
</script>