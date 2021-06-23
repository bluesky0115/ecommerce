<template>
  <div>
  <button class="flex" @click="notificationPopup=true">
   <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
   </svg>
   <span v-if="notifications.length" class="text-3xl">({{notifications.length}})</span>
  </button>
   <div v-if="notificationPopup" class="fixed bg-green z-20">
    <ul>
     <li v-for="notification in notifications" :key="notification.id" >
      <a :href="notification.reference">{{notification.name}}</a>
      <button @click="readNotification(notification.id)">x</button>    
     </li>    
    </ul> 
   </div>
   <!-- <div v-if="notificationPopup" @click="notificationPopup=false" class="absolute -inset-full z-10 bg-black opacity-50">
   <h1>this website wants to send notifications</h1>
   <p>in which category you are interested ?</p>
    <form @submit.prevent="sendNotification">
     <p v-for="category in categories" :key="category.id">
       <input type="checkbox" :key="category.id" value="category.id" v-model="selectedCategories">
       <span>{{category.name}}</span>
     </p>
     <input type="submit" value="">
    </form>
   </div> -->
<div v-if="notificationPopup" @click="notificationPopup=false" class="absolute -inset-full opacity-50 bg-black z-10"></div> 
  </div>  
</template>
<script>
export default {
   props:['userId'],
   data(){
    return{
      notifications:[],
      selectedCategories:[],
      notificationPopup:false  
    }   
   },
   mounted(){
     axios.get('/notifications',{params:{userId:this.userId}})
     .then(res=>{
      if(res.data.notifications){
        this.notifications=res.data.notifications;
      }
     })  
   },
   methods:{
     sendNotification(){
      axios.post('/notification/category',{userId:this.userId,selectedCategories:this.selectedCategories})
      .then(res=>{
        this.notificationPopup=false;
      })
     },
     unreadNotification(notificationId){
       axios.post('/notification/unread',{notificationId:notificationId,userId:this.userId})
       .then(res=>{
           let index=notifications.findindex(item=> item.id==notificationId)
          this.notifications.splice(index,1); 
       })
       .catch(err=>{
        
       });  
     }  
   } 
}
</script>