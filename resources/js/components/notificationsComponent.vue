<template>
  <div>
  <button @click="notificationPopup=true" class="relative mx-8 flex">
   <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
   </svg>
   <span class="absolute -bottom-1 -right-2 w-6 h-6 font-semibold text-white rounded-full bg-green-700 text-white">{{notifications.length}}</span>
  </button>
   <div v-if="notificationPopup" class="fixed bg-gray-100 z-20 text-xl m-2 rounded-md p-2">
    <ul>
     <li v-for="notification in notifications" :key="notification.id" class="hover:bg-blue-200">
      <a :href="notification.data.href">{{notification.data.data}}</a>
      <button @click="readNotification(notification.id)">x</button>    
     </li>    
    </ul> 
   </div>
<div v-if="notificationPopup" @click="notificationPopup=false" class="absolute -inset-x-0 -inset-y-full opacity-50 bg-black z-10"></div> 
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
        this.notifications=res.data.notifications;
     })  
   },
   methods:{
     unreadNotification(notificationId){
       axios.post('/notification/unread',{notificationId:notificationId,userId:this.userId})
       .then(res=>{
          let index=notifications.findindex(item=> item.id==notificationId)
          this.notifications.splice(index,1); 
       }); 
     }  
   } 
}
</script>