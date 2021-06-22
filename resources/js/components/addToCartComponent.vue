<template>
 <form @submit.prevent="addToCart">
  <input type="submit" :value="addText" class="cursor-pointer bg-blue-500 rounded text-white">  
 </form>  
</template>
<script>
 export default{
    props:['productId','userId'],
    data(){
        return{
          addedToCart:false,
          addText:'add'
        }
    },
    methods:{
        addToCart(){
          if(!this.added){
           axios.post('/product/addtocart',{productId:this.productId,userId:this.userId})
          .then(res=>{
            this.addedToCart=true;
            this.addText='added';
            this.$emit('productAddedToCart',this.productId);
          }); 
          }
          else{
           axios.post('/product/removefromcart',{productId:this.productId,userId:this.userId})
           .then(res=>{
             this.addedToCart=false;
             this.addText='add';
             this.$emit('productRemovedFromCart',this.productId);
           })
          }
        }
    }
 }
</script>
