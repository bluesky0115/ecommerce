<template>
  <div>

  </div>
</template>
<script setup>
defineProps({userId})

const completeOrder=()=>{
    axios.post('/order/complete',{orderId:userId})
    .then(res=>{})
    .catch(err=>{})
}

</script>
