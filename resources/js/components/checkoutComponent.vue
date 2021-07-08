<template>
  <div>
   <button @click="checkoutModal=true" class="text-xl bg-blue-500 text-white px-3 py-1 rounded m-1">buy</button>
   <div v-if="checkoutModal" class="fixed z-20 top-1/5 left-1/4 bg-white ">
    <button @click="component=cbeComponent" class="text-white text-xl bg-purple-500 p-3 m-0">cbe birr</button>
    <button @click="coponent=amoleComponent" class="text-white text-xl bg-blue-700 p-3 m-0">amole</button>
    <button @click="component=hellocash" class="text-white text-xl bg-yellow-600 p-3 m-0">hello cash</button>
    <component :is="component" keep-alive/>
   </div> 
    <div v-if="checkoutModal" @click="checkoutModal=false" 
     class="absolute -inset-x-0 -inset-y-full z-10 bg-black opacity-50"></div>  
  </div> 
</template>
<script>
import cbebirr from './payment/cbebirrComponent.vue'
import amole from './payment/amoleComponent.vue'
import hellocash from './payment/hellocashComponent.vue'
export default {
  components:{
    cbebirr,
    amole,
    hellocash,
  },
  props:['userId'],
  data(){
   return{
    checkoutModal:false, 
    component:'cbebirr'
   }
  },
  mounted(){
    axios.get('/user',{params:{userId:this.userId}})
  },
  methods:{
   
  } 
}
</script>