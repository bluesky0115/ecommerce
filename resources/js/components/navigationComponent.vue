<template>
 <div class="flex justify-between bg-green-500 w-full py-1">
  <div class="flex">
    <div class="flex mx-3 p-1">
     <a href="/">
      <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-10 w-10 hover:bg-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
      </svg>   
     </a>  
    </div> 
    <div class="rounded-4xl my-auto py-auto mx-3">
      <form @submit.prevent="search" class="flex">
        <select class="text-gray-700 px-2 text-xl border-r-2 border-gray-400">
          <option value="">Filter</option>
          <option v-for="category in categories" :key="category.id" value="">{{category.name}}</option>
        </select>
       <input type="text" v-model="searchQuery" required class="w-96 py-2.5 px-3 text-lg lg:text-xl xl:text-xl 2xl:text-xl outline-none focus:border-b-2 border-tiruhakim" placeholder="I'am shopping for...">
       <button type="submit" class="capitalize bg-green-700 rounded-r-3xl lg:rounded-r-3xl xl:rounded-r-3xl 2xl:rounded-r-3xl text-xl lg:text-3xl xl:text-2xl 2xl:text-2xl py-2.5 px-5 my-auto" >
         <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
       </button>   
      </form>
    </div>
    <div class="text-xl my-auto text-white text-xl mx-1 hidden lg:block xl:block 2xl:block">
     <ul class="flex list-style-none h-full">
      <li class="my-auto mx-2 hover:bg-green-500 h-full p-1"><a href="/product/create" class="my-auto">add</a></li>
      <li class=" my-auto mx-2 hover:bg-green-500 h-full p-1"><a href="/order" class="my-auto">order</a></li>
      <li class="my-auto mx-2 hover:bg-green-500 h-full p-1"><a href="/about" class="my-auto">contact us</a></li>   
     </ul>   
    </div>
    <div class="my-auto hidden md:flex lg:flex xl:flex 2xl:flex mx-2">
      <div>
       <saved-component :userId="userId"/>   
      </div>
      <div>
       <notifications-component :userId="userId"/>   
      </div> 
      <div>
        <cart-component :userId="userId"/>   
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
   <div class="my-auto mx-3"> 
     <div v-if="userId" class="my-auto hidden lg:inline xl:inline 2xl:inline">
       <button @click="userDropdownMenu=true" class="my-auto">
        <span class="text-xl text-white text-semibold">{{user.name}}</span>
       </button>   
     </div>
     <div v-else class="flex text-white text-xl w-full my-auto">
     <a href="/login" class="mx-2 my-2 rounded px-2 py-1">sign in</a>
     <a href="/register" class="bg-green-800 mx-2 my-2 rounded-2xl px-4 py-2">sign up</a>  
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