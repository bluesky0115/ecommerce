<template>
  <div class="">
   <button @click="cartPopup=true" class="flex relative">
    <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
   <span class="absolute -bottom-1 -right-2 w-6 h-6 font-semibold text-white rounded-full bg-green-700 text-white">{{products.length}}</span>
   </button>
   <div v-if="cartPopup" class="fixed z-20 bg-white text-gray-700">
    <ul>
    <li v-for="cartItem in cartItems" :key="cartItem.id" class="hover:bg-gray-200 px-5">
      <a :href="'/product/show/'+cartItem.id">
       <div class="m-2 p-2">
         <img :src="'/storage/products/'+cartItem.cover" class="w-48">
         <p>{{cartItem.name}}</p>
         <p>{{cartItem.description}}</p>
       </div>
      </a>
    </li>
    </ul>
   </div>
   <div v-if="cartPopup" @click="cartPopup=false" class="absolute z-10 inset-0 bg-black opacity-50"></div>
  </div>
</template>
<script setup>
import removeFromCartVue from './removeFromCart.vue';

let cartId=$ref('')
let cartItems=$ref([])
let cartPopup=$ref(false)
let products=ref([])

onCreated(()=>{
   bus.$on('productAddedToCart',id=>{
     addToCart(id)
   });
   bus.$on('productRemovedFromCart',id=>{
     removeFromCart(id)
   });
})

onMounted(()=>{
    axios.get('/cartitems',{params:{userId:this.userId}})
    .then(res=>{
      cartItems=res.data.cartItems
    })
})

const addToCart=(id)=>{
    axios.get('/product/data',{params:{productId:id}})
    .then(res=>{
    let product=res.data.product
    cartItems.push(product)
    })
}

const removeFromCart=(id)=>{
    let product=cartItems.find(item=>item.id==id)
    cartItems.splice(product)
}

</script>
