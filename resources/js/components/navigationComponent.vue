<template>
 <div class="flex justify-between bg-green-500 w-full py-1">
  <div class="mx-auto px-5">
   <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
   </svg>
  </div>
  <div class="py-1 px-5">
    <div class="flex py-2 border-b-2 border-green-800">
    <div class="rounded-4xl my-auto py-auto mr-5">
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
    <div class="my-auto flex mx-5">
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
    <div class="my-auto mx-3"> 
     <div v-if="userId" class="my-auto hidden lg:inline xl:inline 2xl:inline">
       <button @click="userDropdownMenu=true" class="my-auto">
        <span class="text-xl text-white text-semibold">{{user.name}}</span>
       </button>   
     </div>
     <div v-else class="flex text-white text-2xl w-full my-auto">
     <a href="/login" class="mx-2 my-2 rounded px-2 py-1 my-auto">sign in</a>
     <a href="/register" class="bg-green-800 mx-2 my-2 rounded-3xl px-5 py-2 my-auto">sign up</a>  
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
   <div class="py-2 my-auto text-2xl">
    <ul class="divide-x-2 divide-solid divide-green-800 flex">
      <li><button>Home</button></li>
      <li class="mx-3"><button>Become a Seller</button></li>
      <li class="mx-3"><button>Deals of the Day</button></li>
      <li class="mx-3"><button>News</button></li>
      <li class="mx-3"><button>Vendors</button></li>
      <li>
        <button class="flex">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
          </svg>
          <span>Contact Us</span>
        </button>
      </li>
    </ul>
   </div>
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
   created(){
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