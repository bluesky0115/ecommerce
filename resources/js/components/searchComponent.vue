<template>
<div>
	<div class="lg:mx-4 xl:mx-4 2xl:mx-4 p-1">
		<input type="text" @keyup.enter="search" v-model="searchQuery" required placeholder="search product" class="w-60 rounded border-2 border-gray-500 text-xl py-1 lg:mx-1 xl:mx-1 2xl:mx-1">
		<select v-model="categoryId" required class="my-auto text-xl bg-gray-800 text-white lg:mx-1 xl:mx-1 2xl:mx-1">
			<option value="all">all</option>
			<option v-for="category in categories" :value="category.id" :key="category.id">{{category.name}}</option>  
		</select>
		<button type="submit" @click="search" class="text-xl text-white bg-gray-800 lg:mx-1 xl:mx-1 2xl:mx-1 hover:bg-green-500">
		<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
		</svg>
		</button> 
  </div>
	<div v-if="similarProducts">
   <ul>
		 <li v-for="product in similarProducts" :key="product.id">{{prouct.name}}</li>
	 </ul>
	</div>	
</div>
</template>
<script>
export default {
	data(){
		return{
			searchQuery:'',
		  categoryId:'all',
			products:[]
		}
	},
	computed:{
   similarProucts(){
		return this.proucts.name.match(this.searchQuery);
	 }
	},
	methods:{
	search(){
		if(this.searchQuery){
		document.getElementById('searchQuery').value=this.searchQuery;
		document.getElementById('category').value=this.categoryId;
		document.getElementById('search-form').submit();
		}
   }	
	}
}
</script>