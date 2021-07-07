<template>
	<div>
   <button @click="removeFromcart">{{removeText}}</button>
	</div>
</template>
<script>
export default {
	props:['productId'],
	data(){
		return{
     removeText:'remove from cart'
		}
	},
	methods:{
		removeFromcart(){
     axios.post('/cart/removeProduct',{productId:this.productId,cartId:this.cartId})
		 .then(res=>{
       this.removeText="removed"
		 });
		}
	}
}
</script>