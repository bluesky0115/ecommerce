<template>
  <div>
  
  </div> 
</template>
<script>
export default {
  props:['userId'],
  data(){
   return{
    stripe:{}
   }
  },
  mounted(){
    axios.get('/user',{params:{userId:this.userId}})
  },
  methods:{

  } 
}
</script>