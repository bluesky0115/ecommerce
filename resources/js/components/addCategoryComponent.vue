<template>
  <div>
  <div v-if="eidtPopup" class="fixed z-20 sm:w-full md:w-full">
    <form @submit.prevent="editProfile">
      
    </form>
  </div>
  <div v-if="eidtPopup" @click="eidtPopup=false" class="z-10 absolute -inset-full bg-black opacity-50"></div>
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
      editPopup:false
    }
  },
  mounted(){
    axios.get('/profile',{params:{userId:this.userId}})
    .then(res=>{
      this.phoneNumber=res.data.user.phoneNumber;
      this.city=res.data.user.city;
      this.street=res.data.user.street; 
    });
  },
  methods:{
    editProfile(){
      axios.post('/profile/update',{phoneNumber:this.phoneNumber,city:this.city,street:this.street})
      .then(res=>{
        this.editPopup=false;
      });
    }
  }
}
</script>