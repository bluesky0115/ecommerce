<template>
  <div>
  
  </div> 
</template>
<script>
export default {
  props:[],
  data(){
  return{
    
  }
  },
  mounted(){

  },
  methods:{
   completeOrder(){
     axios.post('/order/complete',{orderId:this.userId})
     .then(res=>{

     })
     .catch(err=>{

     }); 
   }
  } 
}
</script>