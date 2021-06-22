<template>
  <div>
     <button @click="reporting=true" class="text-xl bg-red-500 text-white px-2">report</button>
     <div v-if="reporting" class="bg-white fixed top-1/2 left-1/2 z-20">
       <img :src="'/storage/products/'+product.cover" class="w-48">
       <p>{{product.name}}</p>
       <p>{{product.price}} birr</p>
       <p>{{product.description}}</p>
       <form @submit.prevent="report">
         <button @click="reporting=false" >x</button>
         <textarea v-model="reportText" class="" max="200" required></textarea>
         <input type="submit" value="report" class="">
       </form>
     </div>
     <div v-if="reporting" @click="reporting=false" class="absolute z-10 -inset-full bg-black opacity-50"></div>   
  </div>  
</template>
<script>
export default {
    props:['productId','userId'],
    data(){
     return{
      product:{}, 
      reporting:false,
      reportText:'',
      reportMessage:null
     }
    },
    mounted(){
     axios.get('/product/data',{productId:this.productId})
     .then(res=>{
       this.product=res.data.product;
     });
    },
    methods:{
     report(){
      axios.post('/report',{userId:this.userId,productId:this.productId,reportText:this.reportText})
      .then(res=>{
        this.reportMessage="your report succesfully sent to adminstrators"
        this.reporting=false;
      })     
     }
    }
}
</script>