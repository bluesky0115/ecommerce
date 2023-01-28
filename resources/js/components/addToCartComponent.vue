<template>
  <button @click="addToCart" class="cursor-pointer rounded">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" :class="[productInCart? 'text-green-500':'text-pink-500']" fill="none" viewBox="0 0 24 24" stroke="currentColor">
     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
  </button>
</template>
<script setup>
defineProps({
  productId,
  userId
})

let productInCart=$ref(false)

onMounted(() => {
    axios.get('/cart/product',{params:{userId:this.userId,productId:this.productId}})
     .then(res=>{
        productInCart=res.data.productInCart;
     });
})

const addToCart=()=>{
    if(!productInCart){
    axios.post('/cart/addproduct',{productId:productId,userId:userId})
    .then(res=>{
    productInCart=true;
    bus.$emit('productAddedToCart',productId);
    });
    }
    else{
    axios.post('/cart/removeproduct',{productId:productId,userId:userId})
    .then(res=>{
        productInCart=false;
        emit('productRemovedFromCart',productId);
    })
    }
}

</script>
