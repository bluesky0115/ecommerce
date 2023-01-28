<template>
  <div>
     <button @click="reporting=true" class="text-xl bg-blue-500 text-white px-3 py-1 rounded m-1">report</button>
     <div v-if="reporting" class="absolute top-1/4 left-1/3 bg-white z-20 rounded-xl py-5 px-10">
       <button @click="reporting=false" class="text-3xl absolute top-5 right-5 hover:text-red-500">x</button>
       <img :src="'/storage/products/'+product.cover" class="w-60">
       <p class="text-2xl">{{product.name}}</p>
       <p class="text-xl">{{product.price}} birr</p>
       <p>{{product.description}}</p>
       <p class="text-2xl text-bold">report this product to adminstrators</p>
       <form @submit.prevent="report">
         <textarea v-model="reportText" class="m-3 text-xl block border-2 border-gray-400 rounded-lg w-96 h-40 p-2" max="200" required></textarea>
         <input type="submit" value="report" required class="cusor-pointer m-2 bg-blue-500 text-xl text-white px-3 py-1 rounded">
       </form>
     </div>
     <div v-if="reporting" @click="reporting=false" class="fixed z-10 -inset-x-0 -inset-y-full bg-black opacity-50"></div>
  </div>
</template>
<script setup>
defineProps({productId,userId})

let product=$ref({})
let reporting=$ref(false)
let reportText=$ref('')
let reportMessage=$ref(null)

onMounted=()=>{
    axios.get('/product/data',{params:{productId:productId,userId:userId}})
    .then(res=>{
    product=res.data.product
    })
}

const report=()=>{
    axios.post('/report',{userId:userId,productId:productId,reportText:reportText})
    .then(res=>{
    reportMessage="your report succesfully sent to adminstrators"
    reporting=false
    })
}

</script>
