<template>
 <div class="flex justify-between bg-gray-700 w-full">
  <div class="flex">
    <div class="flex mx-3 p-1">
     <a href="/">
      <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-10 w-10 hover:bg-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
      </svg>   
     </a>  
    </div> 
    <div class="lg:mx-4 xl:mx-4 2xl:mx-4 p-1">
       <input type="text" @keyup.enter="search" v-model="searchQuery" required placeholder="search product" class="px-4 w-48 rounded border-2 border-gray-500 text-xl py-1 lg:mx-1 xl:mx-1 2xl:mx-1">
       <select v-model="categoryId" required class="my-auto text-xl bg-gray-700 text-white lg:mx-1 xl:mx-1 2xl:mx-1">
         <option value="all">all</option>
         <option v-for="category in categories" :value="category.id" :key="category.id">{{category.name}}</option>  
       </select>
       <button type="submit" @click="search" class="text-xl text-white bg-gray-700 lg:mx-1 xl:mx-1 2xl:mx-1 hover:bg-green-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
       </button> 
    </div>
    <div class="text-white text-xl mx-1 hidden lg:block xl:block 2xl:block">
     <ul class="flex list-style-none h-full">
      <li class="my-auto mx-2 hover:bg-green-500 h-full p-1"><a href="/product/create" class="my-auto">add</a></li>
      <li class=" my-auto mx-2 hover:bg-green-500 h-full p-1"><a href="/order" class="my-auto">order</a></li>
      <li class="my-auto mx-2 hover:bg-green-500 h-full p-1"><a href="/about" class="my-auto">contact us</a></li>   
     </ul>   
    </div>
    <div v-if="userId" class="hidden md:flex lg:flex xl:flex 2xl:flex mx-2">
      <div>
       <cart-component :userId="userId"/>   
      </div>
      <div>
       <notifications-component :userId="userId"/>   
      </div>   
    </div>
    <div class="block right-0 lg:hidden xl:hidden 2xl:hidden">
      <button @click="userDropdownMenu=true">
      <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-10 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
    </div>
   </div>
   <div class="mx-3"> 
     <div v-if="userId" class="my-auto hidden lg:inline xl:inline 2xl:inline">
       <button @click="userDropdownMenu=true" class="my-auto">
        <span class="text-xl text-white text-semibold">{{user.name}}</span>
       </button>   
     </div>
     <div v-else class="flex text-white text-xl w-full">
     <a href="/login" class="bg-blue-500 mx-2 my-2 rounded px-2 py-1">sign in</a>
     <a href="/register" class="bg-green-500 mx-2 my-2 rounded px-2 py-1">sign up</a>  
     </div> 
     <div v-if="userDropdownMenu" class="fixed z-20 text-xl bg-gray-100 top-2 right-2">
      <ul>
       <li class="hover:bg-blue-200 px-5 py-1"><a href="/">home</a></li>
       <li class="hover:bg-blue-200 px-5 py-1"><a href="/profile/edit">my profile</a></li>
       <li class="hover:bg-blue-200 px-5 py-1"><a href="/user/products">my products</a></li>
       <li class="hover:bg-blue-200 px-5 py-1"><a href="/product/create">add product</a></li>
       <li class="hover:bg-blue-200 px-5 py-1"><a href="/order">order</a></li>
       <li class="hover:bg-blue-200 px-5 py-1"><a href="/about">contact us</a></li>
       <li class="hover:bg-blue-200 px-5 py-1">
        <button @click="logout">logout</button>  
       </li>  
      </ul>
     </div>
     <div v-if="userDropdownMenu" @click="userDropdownMenu=false" class="absolute z-10 -inset-y-0 -inset-x-0 bg-black opacity-50"></div>
    </div> 
 </div>
</template>
<script>
export default {
   props:['userId'],
   data(){
    return{
      user:{},
      categoryId:'all',
      searchQuery:'',
      categories:[],
      userDropdownMenu:false,
    }
   },
   mounted(){
    axios.get('/navigation',{params:{userId:this.userId}})
    .then(res=>{
      this.user=res.data.user;
      this.categories=res.data.categories;
    })
   },
   methods:{
    search(){
      if(this.searchQuery){
      document.getElementById('searchQuery').value=this.searchQuery;
      document.getElementById('category').value=this.categoryId;
      document.getElementById('search-form').submit();
      }
    },
    logout(){
      document.getElementById('logout-form').submit(); 
    }
   }
}
</script>