<template>
  <div>
  <div>
    <form @submit.prevent="editProfile">
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

}
</script>