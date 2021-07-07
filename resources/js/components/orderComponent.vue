<template>
  <div class="bg-white rounded-xl my-5 p-5 mx-2 lg:mx-auto xl:mx-auto 2xl:mx-auto w-full lg:w-3/4 xl:w-3/4 2xl:w-3/4">
   <p class="text-3xl text-center pb-2 border-b-2 border-gray-400">Items in your cart({{cartItems.length}})</p>
    <div class="flex">
     <div v-for="cartItem in cartItems" :key="cartItem.id" class="m-1 p-1 block lg:flex xl:flex 2xl:flex">
     <div class="p-2 border-5 border-gray-300 flex" 
     :class="cartItem.selected? 'border-green-500': 'border-blue-500'">
      <img :src="'/storage/products/'+cartItem.cover" class="w-48">
     <div class="my-auto mx-3">
      <input type="checkbox" class="border-2 form-checkbox text-green-500 h-10 w-10" @click="addOrderItem(cartItem.id,cartItem.quantity)">
      <p>
      <span class="text-xl">quantity</span>
      <select required v-model="cartItem.quantity">
       <option value="1" class="">1</option>
       <option value="2" class="">2</option>
       <option value="3" class="">3</option>
       <option value="4" class="">4</option>
       <option value="5" class="">5</option>
      </select> 
      </p>
      <p class="text-xl">amount {{cartItem.price*cartItem.quantity}}</p>
    </div>
    </div>
    </div>   
    </div>
    <p v-if="totalPrice" class="text-xl">total price {{totalPrice}}</p>
    <form v-if="orderItems.length" @submit.prevent="order">
     <input type="submit" value="order" class="block m-auto bg-green-500 text-2xl text-white px-5 py-1 mt-5 rounded-md cursor-pointer">
   </form>
  </div> 
</template>
<script>
export default {

 props:['userId'],

 data(){
  return{
   cartItems:[],
   orderItems:[],
   totalPrice:null,
  }
 },

 mounted(){
  axios.get('/cartitems',{params:{userId:this.userId}})
  .then(res=>{
    this.cartItems=res.data.cartItems;
    this.cartItems.forEach(cartItem=>{
      cartItem.quantity=1;
      cartItem.selected=false;
    });
  })
 },

 methods:{
   addOrderItem(cartItemId,quantity){
     let orderItem=this.cartItems.find(item=>item.id==cartItemId);
    if(orderItem){
      let index=this.orderItems.findIndex(item=>item.id==cartItemId)
      this.orderItems.splice(index,1);
    }
    else{
      let orderItem;
      orderItem.id=cartItemId;
      orerItem.quantity=quantity;
      this.orderItems.push(OrderItem);
      let cartItem=this.cartItems.find(item=>item.id==cartItemId);
      cartItem.selected=true;
    }
   },
   order(){
     axios.post('/order',{userId:this.userId,orderItems:this.orderItems})
     .then(res=>{
      for(id in orderItems){
        let index=this.cartItems.findIndex(item=>item.id==id)
        this.cartItems.splice(index,1);
      }
     }); 
   }
 }  
}
</script>