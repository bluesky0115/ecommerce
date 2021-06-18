<template>
  <div>
   <div>
    <ul>
     <li v-for="notification in notifications" :key="notification.id" >
      <a :href="notification.reference">{{notification.name}}</a>
      <button @click="readNotification(notification.id)">x</button>    
     </li>    
    </ul> 
   </div>   
  </div>  
</template>
<script>
export default {
   props:['userId'],
   data(){
    return{
      notifications:[],  
    }   
   },
   mounted(){
     axios.get('notifications',{params:{userId:this.userId}})
     .then(res=>{
      this.notifications=res.data.notifications;
     })  
   },
   methods:{
     unreadNotification(notificationId){
       axios.post('/notification/unread',{notificationId:notificationId,userId:this.userId})
       .then(res=>{
           let notification=notifications.find(notificationId)
          this.notification.remove(notification); 
       })
       .catch(err=>{
        
       });  
     }  
   } 
}
</script>