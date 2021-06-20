<template>
  <div>
  <div v-if="!hasProfile" class="fixed z-20 sm:w-full md:w-full">
    <form @submit.prevent="createProfile">
      <p class="">phone number</p>
      <input type="text" name="phone_number" required class="" >
      <p class="">city</p>
      <input type="text" name="city" required class="">
      <p class="">street</p>
      <input type="text" name="street" required class="">
      <input type="submit" value="create profile" class="">
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