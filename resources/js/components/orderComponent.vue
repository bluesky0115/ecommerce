<template>
  <div>
   <div v-for="item in cartItems" :key="item.id" class="flex">
   <input type="checkbox" v-model="orderedItems">
    <img src="" alt="">
    <div class="my-auto">
     <p>
      <span>quantity</span>
      <select name="" id="" required v-model="" @change="">
       <option value="1" selected>1</option>
       <option value="2">2</option>
       <option value="2">3</option>
       <option value="2">4</option>
       <option value="2">5</option>
       <option value="2">6</option>
       <option value="2">7</option>
       <option value="2">8</option>
       <option value="2">9</option>
       <option value="2">10</option>
      </select>
      </p>
      <p>amount {{itemAmount}}</p>
    </div>
   </div>
  </div> 
</template>
<script>
export default {

 props:['userId'],

 data(){
  return{
   cartItems:[],
   orderItems:[]
  }
 },

 mounted(){
  axios.get('/order',{params:{userId:this.userId}})
  .then(res=>{

  })
  .catch(err=>{

  })
 },

 methods:{
   itemAmount(item,amount){
    item.price*amount;
   },
   order(){
     axios.post('/order',{}) 
   }
 }  
}
</script>