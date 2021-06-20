<template>
  <div>
  <div>
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
  </div>
</template>
<script>
export default {
  props:['userId'],
  data(){
    return{
      phoneNumber:'',
      city:'',
      street:''
    }
  },
  mounted(){

  },
  methods:{
    createProfile(){
     aios.post('/profile/create',{phoneNumber:this.phoneNumber,city:this.city,street:this.street})
     .then(res=>{

     })
    }
  }
}
</script>