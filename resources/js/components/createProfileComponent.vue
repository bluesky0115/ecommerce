<template>
  <div>
  <div v-if="!hasProfile" class="fixed z-20 sm:w-full md:w-full">
    <form @submit.prevent="createProfile">
      
    </form>
  </div>
  <div v-if="!hasProfile" @click="createPopup=false" class="z-10 absolute -inset-full bg-black opacity-50"></div>
  </div>
</template>
<script>
export default {
  props:['userId'],
  data(){
    return{
      phoneNumber:'',
      city:'',
      street:'',
      createPopup:false,
      hasProfile:true
    }
  },
  mounted(){
   axios.get('/user/profile',{params:{userId:this.userd}})
   .then(res=>{
     this.hasProfile=res.data.hasProfile;
   })
  },
  methods:{
    createProfile(){
     aios.post('/profile/create',{phoneNumber:this.phoneNumber,city:this.city,street:this.street})
     .then(res=>{
       this.hasProfile=true;
     })
    }
  }
}
</script>