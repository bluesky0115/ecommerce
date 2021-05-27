<template>
    <button @click="deleteProduct" :disabled="deleted" :class="[deleted ? 'bg-secondary' :'']"
     class="bg-red-600 text-xl text-gray-100 p-1 uppercase">{{deleteText}}</button>
</template>
<script>
export default {
    props:['productId'],
    data(){
      return{
        deletedText:'delete',
        deleted:false,
        product:{
        
        }
      }  
    },
    methods:{
       deleteProduct(){
         if(confirm('are you sure to delete '+this.product.name+' ?')){ 
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
}
</script>