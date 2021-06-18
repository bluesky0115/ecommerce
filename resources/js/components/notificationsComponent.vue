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
   <div v-if="notificationPopup" class="">
   <h1>this website wants to send notifications</h1>
   <p>in which category you are interested ?</p>
    <form @submit.prevent="sendNotification">
     <p v-for="category in categories">
       <input type="checkbox" :key="category.id" value="category.id" v-model="selectedCategories">
       <span>{{category.name}}</span>
     </p>
     <input type="submit" value="">
    </form>
   </div>
   <div v-if="" @click="=false" class="absolute z-10 -inset-full bg-black opacity-50"></div>  
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
     axios.get('notifications',{params:{userId:this.userId}})
     .then(res=>{
      this.notifications=res.data.notifications;
     })  
   },
   methods:{
     sendNotification(){
      axios.post('/notification/category',{userId:this.userId,selectedCategories:this.selectedCategories})
      .then(res=>{
        this.notificationPopup=false;
      })
     }
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