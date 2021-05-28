<template>
<div>
  <button @click="readyToDelete=true"
     class="bg-red-600 text-xl text-gray-100 p-1 uppercase">{{deleteText}}
  </button>
  <div v-if="readyToDelete" class="absolute inset-0 z-20 flex justify-center items-center">
    <div class="w-1/3 rounded-xl bg-gray-200">
     <form @submit.prevent="deleteProduct">
      <input type="submit" value="delete">
     </form>
    </div>
  </div>
  <div v-if="readyToDelete" class="absolute inset-0 opacity-50 bg-black z-10"></div>
</div>
</template>
<script>
export default {
    props:['productId'],
    data(){
      return{
        deletedText:'delete',
        deleted:false,
        readyToDelete:false,
        product:{
        
        }
      }  
    },
    methods:{
       deleteProduct(){
           axios.post('product/delete',{productId:this.productId})
           .then(res=>{
             this.deleted=true;
             this.deleteText='deleted';
           })
           .catch(err=>{
             
           });
        }
    } 
}
</script>