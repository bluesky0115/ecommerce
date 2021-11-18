<template>
 <div class="flex justify-evenly bg-first w-full py-1">
  <div class="">
   <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
   </svg>
  </div>
  <div class="py-1 pr-5 mx-2 mx-5">
    <div class="flex justify-between py-2 border-b-2 border-green-600">
    <div class="rounded-4xl my-auto py-auto mr-5">
      <form @submit.prevent="search" class="flex">
        <select class="text-gray-700 px-2 text-xl border-r-2 border-green-700">
          <option value="">Filter</option>
          <option v-for="category in categories" :key="category.id" value="">{{category.name}}</option>
        </select>
       <input type="text" v-model="searchQuery" required class="w-96 py-2.5 px-3 text-lg lg:text-xl xl:text-xl 2xl:text-xl outline-none focus:border-b-2 border-tiruhakim" placeholder="I'am shopping for...">
       <button type="submit" class="bg-second capitalize rounded-r-3xl lg:rounded-r-3xl xl:rounded-r-3xl 2xl:rounded-r-3xl text-xl lg:text-3xl xl:text-2xl 2xl:text-2xl py-2.5 px-5 my-auto">
         <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
       </button>   
      </form>
    </div>
    <div class="my-auto flex mx-14">
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
    <div class="hidden">
      <button @click="userDropdownMenu=true">
      <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-10 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
    </div>
    <div class="my-auto ml-5"> 
     <div v-if="userId" class="my-auto inline">
       <button @click="userDropdownMenu=true" class="my-auto flex">
        <span class="text-xl capitalize">{{user.name}}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
       </button>   
     </div>
     <div v-else class="flex text-white text-2xl w-full my-auto">
     <a href="/login" class="mx-2 rounded px-2 py-1 my-auto">sign in</a>
     <a href="/register" class="bg-green-700 mx-2  rounded-3xl px-5 py-1.5 my-auto">sign up</a>  
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
   <div class="py-2 my-auto flex justify-between">
    <div class="bg-green-600 flex rounded-sm">
      <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
      <select class="bg-green-600 my-auto text-xl text-white">
        <option value="" class="my-auto">Shop by Category</option>
        <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
      </select>
    </div>
    <div class="text-lg my-auto">
      <ul class="flex my-auto">
       <li class="mx-4"><a class="mx-auto text-black no-underline" href="/">Home</a></li>
       <li class="mx-4"><a class="mx-auto text-black no-underline" href="/">News</a></li>
       <li class="mx-4"><a class="mx-auto text-black no-underline" href="/">Vendors</a></li>
       <li class="mx-4 "><a class="mx-auto text-black no-underline" href="/">Suppliers</a></li>
      </ul>
    </div>
    <div class="text-xl">
     <ul class="flex">
       <li class="mx-3">
         <button>
           Become a Seller
         </button>
       </li>
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