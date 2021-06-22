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
  <p v-if="userId==comment.user.id" class="mx-2">
        <button @click="editing=true;editedId=comment.id;editedBody=comment.body" class="rounded text-blue-500 text-lg px-2 mx-1">edit</button>
        <button @click="deleting=true;deletedId=comment.id;" class="rounded text-red-500 text-lg px-2 mx-1">delete</button>
      </p>
     <div v-if="editing" class="fixed z-20 bottom-1/3 left-1/3 px-10 py-2 bg-gray-300 rounded-xl">
      <button @click="editing=false" class="absolute top-0 right-0 text-4xl px-3 text-red-500">x</button>
      <p class="text-2xl text-center mt-10 mb-2 text-gray-900">Edit your comment</p>
      <form v-if="editing" @submit.prevent="editComment(editedId)">
         <textarea name="description" v-model="editedBody" 
         class="text-xl m-auto p-2 w-full h-40 rounded-xl border-2"></textarea>
         <input type="submit" value="edit comment" class="rounded bg-green-500 m-auto text-white text-2xl py-1 px-2"> 
      </form> 
     </div>  
  <div v-if="deleting" @click="deleting=false" class="absolute -inset-full opacity-50 bg-black z-10"></div>
     <div v-if="deleting" class="fixed z-20 bottom-1/3 left-1/3 px-2 py-2 bg-white rounded-xl">
      <button @click="deleting=false" class="absolute top-0 right-0 text-4xl px-3 text:gray-600 hover:text-red-500">x</button>
      <p class="text-2xl text-center mt-10 mb-2 text-gray-900">are you sure to delete remember this is unchangable</p>
      <form @submit.prevent="deleteComment(deletedId)">
         <input type="submit" value="delete anyways" class="block rounded bg-red-500 mx-auto my-3 text-white text-2xl py-1 px-2"> 
      </form> 
     </div>
  </div>      
</template>
<script>
export default {
   props:['productId','userId'],
   data(){
    return{
     body:'',
     editedBody:'',
     editedId:null,
     deletedId:null
    }
   },
   mounted(){
     axios.get('/comments',{params:{productId:this.productId,userId:this.userId}})
          .then(res=>{
            this.comments=res.data.comments;
            this.user=res.data.user;
            console.log(res.data.comments);
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
     },
     editComment(id){
       axios.patch('/comment/update',{body:this.editedBody,commentId:id})
        .then(res=>{
          var comment=this.comments.find(comment=>{
            return comment.id==id });
          comment.body=this.editedBody;
          this.editing=false;
        })
        .catch(res=>{
        });  
     },
     deleteComment(id){
      axios.delete('/comment/delete',{params:{commentId:id}})
        .then(res=>{
          var comment=this.comments.find(comment=>{
            return comment.id==id;
          });
          this.comments.pop(comment);
          this.deleting=false;
        })
        .catch(res=>{
        });  
        }
    }    
}
</script>