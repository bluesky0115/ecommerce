<template>
 <button @click="addToCart" class="">{{buttonText}}</button>  
</template>

<script>
 export default{
    props:['productId','userId'],
    data(){
        return{
          buttonText:'add to cart'
        }
    },
    methods:{
        addToCart(){
          axios.post('/product/addtocart',{productId:this.productId,userId:this.userId})
          .then(res=>{
            this.buttonText='added'
          })
          .catch(err=>{
            
          });
        }
    }
 }
</script>
