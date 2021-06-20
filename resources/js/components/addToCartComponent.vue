<template>
 <form @submit.prevent="addToCart">
  <input type="submit" :value="buttonText" class="text-md text-white rounded" :class="[added ? 'bg-green-500' : 'bg-blue-500']"> 
  </form>  
</template>
<script>
 export default{
    props:['productId','userId'],
    data(){
        return{
          added:false,
          buttonText:'add to cart'
        }
    },
    methods:{
        addToCart(){
          axios.post('/product/addtocart',{productId:this.productId,userId:this.userId})
          .then(res=>{
            this.addded=true;
            this.buttonText='added';
          })
          .catch(err=>{
            
          });
        }
    }
 }
</script>
