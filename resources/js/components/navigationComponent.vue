<template>
   <div>
    <button @click="navWidth=50">
     <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
     </svg>
    </button>
    <div v-if="displayMenu" :style="{width: navWidth+'%'}" class="fixed z-20">
     <ul>
      <li></li>
     </ul>
    </div>
    <div v-if="displayMenu" @click="displayMenu=false" class="absolute z-10 -inset-full bg-black opacity-50"></div>
   </div>
</template>
<script>
export default {
   props:['userId'],
   data(){
    return{
     displayMenu:false,
     navWidth:0  
    }
   },
   mounted(){
    axios.get('/menu',{params:{userId:this.userId}})
    .then(res=>{

    })
    .catch(err=>{

    });
   },
   methods:{

   }
}
</script>