<template>
 <button @click="addToCart" class="text-xl text-white rounded" :class="[added ? 'bg-green-500' : 'bg-blue-500']">{{buttonText}}</button>  
</template>
<script>
 export default{
    props:['productId','userId'],
    data(){
        return{
          added:false,
          addText:'add to cart'
        }
    },
    methods:{
        addToCart(){
          axios.post('/product/addtocart',{productId:this.productId,userId:this.userId})
          .then(res=>{
            this.addded=true;
            this.addText='added';
          })
          .catch(err=>{
            
          });
        }
    }
 }
</script>
