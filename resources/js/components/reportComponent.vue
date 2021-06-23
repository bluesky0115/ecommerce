<template>
  <div>
     <button @click="reporting=true" class="text-xl bg-red-500 text-white px-2">report</button>
     <div v-if="reporting" class="bg-white relative z-20 rounded-xl p-10">
       <button @click="reporting=false" class="text-2xl absolute top-5 right-5 hover:text-red-500">x</button>
       <img :src="'/storage/products/'+product.cover" class="w-48">
       <p class="text-xl">{{product.name}}</p>
       <p class="text-xl">{{product.price}} birr</p>
       <p>{{product.description}}</p>
       <form @submit.prevent="report">
         <textarea v-model="reportText" class="block border-2 border-gray-400 rounded-lg w-full h-40" max="200" required></textarea>
         <input type="submit" value="report" class="m-2 bg-green-500 text-xl text-white px-3 py-1 rounded">
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
     axios.get('/product/data',{params:{productId:this.productId,userId:this.userId}})
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