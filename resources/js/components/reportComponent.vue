<template>
  <div>
   <div>
     <button @click="reporting=true">report</button>
     <div v-if="reporting" class="fixed z-20">
       <button @click="reporting=false" >x</button>
       <form action="" @submit.prevent="report">
         <textarea v-model="reportText" class="" max="200" required></textarea>
         <input type="submit" value="report" class="">
       </form>
     </div>
     <div v-if="reporting" @click="reporting=false" class="absolute z-10 -inset-full bg-black opacity-50"></div>
   </div>   
  </div>  
</template>
<script>
export default {
    props:['productId','userId'],
    data(){
     return{
      reporting:false,
      reportText:'',
      reportMessage:null
     }
    },
    methods:{
     report(){
      axios.post('/report',{userId:this.userId,productId:this.productId,reportText:this.reportText})
      .then(res=>{
        this.reportMessage="your report succesfully sent to adminstrators"
        this.reporting=false
      })     
     }
    }
}
</script>