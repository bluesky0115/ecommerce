<template>
  <div>
  <div v-if="eidtPopup" class="fixed z-20 sm:w-full md:w-full">
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
  <div v-if="eidtPopup" @click="eidtPopup=false" class="z-10 absolute -inset-full bg-black opacity-50"></div>
  </div>
</template>
<script setup>
defineProps({
  userId,productId
})

let phoneNumber=$ref('')
let city=$ref('')
let street=$ref('')
let editPopup=$ref(false)

onMounted=()=>{
    axios.get('/profile',{params:{userId:userId}})
    .then(res=>{
      phoneNumber=res.data.user.phoneNumber
      city=res.data.user.city
      street=res.data.user.street
    })
}

const editProfile=()=>{
    axios.post('/profile/update',{phoneNumber:phoneNumber,city:city,street:street})
    .then(res=>{
    editPopup=false
    })
}

</script>
