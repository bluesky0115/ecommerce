<template>
  <button @click="addCategory">add category</button>
  <div v-if="categoryPopup" class="fixed z-20 sm:w-full md:w-full">
    <form @submit.prevent="createCategory">
      <input type="text" v-model="categoryName" placeholder="category name" required class="">
      <input type="submit" value="add category" class="">
    </form>
  </div>
  <div v-if="categoryPopup" @click="categoryPopup=false" class="z-10 absolute -inset-full bg-black opacity-50"></div>
</template>
<script setup>
import { onMounted, ref } from '@vue/runtime-core'

let isAdmin=$ref(false)
let categoryName=$ref('')
let categoryPopup=ref(false)

defineProps({
    userId:{}
})
onMounted(() => {
    axios.get('/isAdmin',{params:{userId:this.userId}})
    .then(res=>{
      isAdmin=res.data.isAdmin;
    });
})

const addcategory=()=>{
    axios.get('/isAdmin',{params:{userId:this.userId}})
    .then(res=>{
      isAdmin=res.data.isAdmin;
    });
}
</script>
