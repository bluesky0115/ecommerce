<template>
  <div>
   <form @submit.prevent="order">
     <div v-for="cartItem in cartItems" :key="cartItem.id" class="flex">
    <div class="flex">
     <input type="checkbox" value="cartItem.id" @change="addOrderItem(cartItem.id,cartItem.quantity)">
    <img src="" alt="">
    <div class="my-auto">
     <p>
      <span>quantity</span>
      <select name="" id="" required v-model="cartItem.quantity">
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
      <p v-if="">amount {{cartItem.price*cartItem.quantity}}</p>
    </div>
    </div>
   </div>
   <input type="submit" value="order" class="">
   </form>
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
  axios.get('/cartItems',{params:{userId:this.userId}})
  .then(res=>{
    this.cartItems=res.data.cartItems;
  })
  .catch(err=>{

  })
 },

 methods:{
   addOrderItem(cartItemId,quantity){
    if(orderItems.find(item=>item.id==cartItemId)){
      orderItems.splice(item=>item.id=cartItemId,1); 
    }
    else{
      let orderItem=cartItems.find(item=>item.id==cartItemId);
      orderItem.quantity=quantity;
      orderitems.push(orderItem);
    }
   },
   order(){
     axios.post('/order',{userId:this.userId,cartItems:this.orderItems})
     .then(res=>{
      for(id in orderItems.id){
        $cartItems.splice($cartItems.findIndex(item=>item.id==id),1);
      }
     })
     .catch(err=>{

     }); 
   }
 }  
}
</script>