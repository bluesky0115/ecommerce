<template>
  <div class="bg-white rounded-xl my-5 p-5 mx-auto w-full lg:w-3/4 xl:w-3/4 2xl:w-3/4">
   <p class="text-3xl text-center mb-3 border-bottom-2 border-gray-600">Items in your cart({{cartItems.length}})</p>
    <div class="flex">
     <div v-for="cartItem in cartItems" :key="cartItem.id" class="">
      <div>
       <input type="checkbox" :value="cartItem" v-model="orderItems" class="p-2">
      </div>
     <img :src="'/storage/products/'+cartItem.cover" class="w-40">
     <div class="my-auto">
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
      <p v-if="cartItem.quantity" class="text-xl">amount {{cartItem.price*cartItem.quantity}}</p>
    </div>
    </div>   
    </div>
    <p v-if="totalPrice" class="text-xl">total price {{totalPrice}}</p>
    <form @submit.prevent="order">
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
    });
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
     }); 
   }
 }  
}
</script>