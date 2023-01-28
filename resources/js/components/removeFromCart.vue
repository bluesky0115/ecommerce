<template>
	<div>
   <button @click="removeFromcart">{{removeText}}</button>
	</div>
</template>
<script setup>
defineProps({productId})

let removeText=$ref('remove from cart')

const removeFromcart=()=>{
  axios.post('/cart/removeProduct',{productId:productId,cartId:cartId})
  .then(res=>{
  removeText="removed"
  });
}

</script>
