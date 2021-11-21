<template>
 <div>
  <button class="relative">
    <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
    </svg>
    <span class="absolute -bottom-1 -right-2 w-6 h-6 font-semibold text-white rounded-full bg-green-700 text-white">{{products.length}}</span>
  </button>     
 </div>  
</template>
<script>
export default {
  data(){
   return{ 
    products:[]
   }
  },
  mounted(){

  },
  methods:{
    
  }
}
</script>
