<template>
 <button @click="addToCart">
  <img v-if="!addedToCart" src="/icons/addToCart.png" class="w-10 h-10">
  <img v-else src="/icons/added.png" class="w-10 h-10">   
 </button>  
</template>
<script>
 export default{
    props:['productId','userId'],
    data(){
        return{
          addedToCart:false,
        }
    },
    methods:{
        addToCart(){
          if(!this.added){
           axios.post('/product/addtocart',{productId:this.productId,userId:this.userId})
          .then(res=>{
            this.addedToCart=true;
          }); 
          }
          else{
           axios.post('/product/removefromcart',{productId:this.productId,userId:this.userId})
           .then(res=>{
             this.addedToCart=false;
           })
          }
        }
    }
 }
</script>
