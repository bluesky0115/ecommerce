<template>
<div>
  <button @click="readyToDelete=true"
     class="m-1 bg-red-600 text-xl text-white px-3 py-1 rounded">delete
  </button>
  <div v-if="readyToDelete" class="absolute inset-0 z-20 flex justify-center items-center">
    <div class="w-1/3 rounded-xl bg-gray-200">
     <p class="text-xl text-center">ready to delete this product?</p>
     <p class="text-xl text-center">remember this action is unchangeable</p>
     <form @submit.prevent="deleteProduct">
      <input type="submit" value="delete" class="block mx-auto m-1 text-xl bg-red-500 text-white px-2 rounded cursor-pointer">
     </form>
    </div>
  </div>
  <div v-if="readyToDelete" @click="readyToDelete=false" class="absolute -inset-full opacity-50 bg-black z-10"></div>
</div>
</template>
<script>
defineProps({productId})
let readyToDelete=$ref(false)

const deleteProduct=()=>{
    axios.post('product/delete',{productId:productId})
    .then(res=>{
        deleted=true
        deleteText='deleted'
    })
    .catch(err=>{

    })
}
</script>
