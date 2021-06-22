<template>
 <div>
  <p class="text-2xl mx-3">{{comments.length}} comments</p>
  <div v-if="userId">
    <p class="text-xl mx-3">comment as {{user.name}}</p>
   <form action="" @submit.prevent="addComment">
    <textarea name="description" rows="5" required
        class="text-lg w-2/3 block h-40 m-2 p-2 rounded-lg border-2 border-gray-200" v-model="body"></textarea>
    <input type="submit" value="comment" class="rounded bg-green-500 text-white text-xl py-1 px-2">
   </form> 
  </div>
  <div v-else>
   <p class="text-xl">sign in to comment <a href="/login" class="no-underline text-xl text-blue-500 m-1">sign in</a></p>
  </div>
  <div v-for="comment in comments" :key="comment.id" class="shadow-sm rounded bg-blue-100 m-4 p-3">
    <p class="">
      <span class="text-lg font-semibold">{{comment.user.name}}</span>
      <span class="mx-4">{{comment.created_at}}</span>  
    </p>
    <p class="text-lg">{{comment.body}}</p>
  </div>
 </div>      
</template>
<script>
export default {
   props:['productId','userId'],
   data(){
    return{
     body:'',
     comments:[],
    }
   },
   mounted(){
     axios.get('/comments',{params:{productId:this.productId,userId:this.userId}})
          .then(res=>{
            this.comments=res.data.comments;
            this.user=res.data.user;
          });           
   },
   methods:{
     addComment()
     {
      axios.post('/comment/store',{productId:this.productId,userId:this.userId,body:this.body})
           .then(res=>{
             let comment=res.data.comment;
             this.comments.push(comment);
             this.body='';
           }).
           catch(err=>{
           });
     }
    }    
}
</script>