<template>
   <div>

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
    axios.get('/product/category',{params:{categoryId:this.categoryId}})
    .then(res=>{
      this.products=res.data.products;
    })
  }
}
</script>