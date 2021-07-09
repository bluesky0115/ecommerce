<template>
  <button @click="addToCart" class="cursor-pointer rounded">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" :class="[productInCart? 'text-green-500':'text-pink-500']" fill="none" viewBox="0 0 24 24" stroke="currentColor">
     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
  </button> 
</template>
<script>
 import { bus } from 'app';
 export default{
    props:['productId','userId'],
    data(){
        return{
          productInCart:false,
        }
    },
    mounted(){
     axios.get('/cart/product',{params:{userId:this.userId,productId:this.productId}})
     .then(res=>{
        this.productInCart=res.data.productInCart;
     });
    },
    methods:{
        addToCart(){
          if(!this.productInCart){
           axios.post('/cart/addproduct',{productId:this.productId,userId:this.userId})
          .then(res=>{
            this.productInCart=true;
            bus.$emit('productAddedToCart',this.productId);
          }); 
          }
          else{
           axios.post('/cart/removeproduct',{productId:this.productId,userId:this.userId})
           .then(res=>{
             this.productInCart=false;
             this.$emit('productRemovedFromCart',this.productId);
           })
          }
        }
    }
 }
</script>
