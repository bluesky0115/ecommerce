<template>
 <div>
  <p class="text-2xl my-2 text-gray-700">Reviews({{comments.length}} total reviews)</p>
  <div>
   <form action="" @submit.prevent="addComment">
     <input type="text" class="p-2 w-full my-2 rounded-md " placeholder="Name">
     <input type="email" class="p-2 w-full my-2 rounded-md" placeholder="Email">
     <p class="text-3xl">
      <span class="text-gray-300">★</span>
      <span class="text-gray-300">★</span>
      <span class="text-gray-300">★</span>
      <span class="text-gray-300">★</span>
      <span class="text-gray-300">★</span>
     </p>
    <textarea name="description" rows="5" required
        class="my-2 text-lg w-full block h-30 p-2 rounded-lg" v-model="body"></textarea>
    <input type="submit" value="submit" class="my-2 cursor-pointer rounded-lg bg-second text-white text-xl py-1 px-4">
   </form> 
  </div>
  <div v-for="comment in comments" :key="comment.id" class="shadow-sm rounded bg-white m-4 p-3">
    <p class="">
      <span class="text-lg font-semibold">{{comment.user.name}}</span>
      <span class="mx-4">{{comment.created_at}}</span>  
    </p>
    <p class="text-lg">{{comment.body}}</p>
    <p v-if="userId==comment.user.id" class="mx-2">
      <button @click="editing=true;editedId=comment.id;editedBody=comment.body" class="rounded text-blue-500 text-lg px-2 mx-1">edit</button>
      <button @click="deleting=true;deletedId=comment.id;" class="rounded text-red-500 text-lg px-2 mx-1">delete</button>
    </p>
  </div>
     <div v-if="editing" class="fixed z-20 bottom-1/3 left-1/3 px-10 py-2 bg-gray-300 rounded-xl">
      <button @click="editing=false" class="absolute top-0 right-0 text-4xl px-3 text-red-500">x</button>
      <p class="text-2xl text-center mt-10 mb-2 text-gray-900">Edit your comment</p>
      <form v-if="editing" @submit.prevent="editComment(editedId)">
         <textarea name="description" v-model="editedBody" 
         class="text-xl m-auto p-2 w-full h-40 rounded-xl border-2 border-gray-500"></textarea>
         <input type="submit" value="edit comment" class="rounded bg-green-500 m-auto text-white text-2xl py-1 px-2"> 
      </form> 
     </div>  
  <div v-if="editing" @click="editing=false" class="absolute -inset-full opacity-50 bg-black z-10"></div>
     <div v-if="deleting" class="fixed z-20 bottom-1/3 left-1/3 px-2 py-2 bg-white rounded-xl">
      <button @click="deleting=false" class="absolute top-0 right-0 text-4xl px-3 text:gray-600 hover:text-red-500">x</button>
      <p class="text-2xl text-center mt-10 mb-2 text-gray-900">are you sure to delete this comment remember this is unchangable</p>
      <form @submit.prevent="deleteComment(deletedId)">
         <input type="submit" value="delete anyways" class="block rounded bg-red-500 mx-auto my-3 text-white text-2xl py-1 px-2"> 
      </form> 
     </div>
     <div v-if="deleting" @click="deleting=false" class="absolute -inset-full opacity-50 bg-black z-10"></div>
  </div>      
</template>
<script>
export default {
   props:['productId','userId'],
   data(){
    return{
     body:'',
     editing:false,
     deleting:false,
     editedBody:'',
     editedId:null,
     deletedId:null,
     comment:{id:null,user:{},body:''},
     comments:[],
     user:{}
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
          var deletedComment=this.comments.find(comment=>{
            return comment.id==id;
          });
          this.comments.splice(this.comments.findIndex(comment=>comment.id==deletedComment.id));
          this.deleting=false;
        })
        .catch(res=>{
        });  
        }
    }    
}
</script>