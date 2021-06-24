<template>
 <div class="flex space-between bg-gray-800 p-2">
  <div class="flex">
    <div class="mx-4">
     <a href="/home">
      <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
      </svg>   
     </a>  
    </div> 
    <div class="mx-4">
      <form @submit.prevent="search" class="flex my-auto">
       <input type="text" name="searchQuery" required class="text-gray-700 my-auto rounded border-2 border-gray-500 text-xl py-1 px-3 mx-1">
       <select name="category" id="" required class="my-auto text-xl bg-gray-800 text-white">
         <option value="all" selected>all</option>
         <option v-for="category in categories" :value="category.id" :key="category.id">{{category.name}}</option>  
       </select>
       <input type="submit" value="search" class="text-xl text-white bg-gray-800">    
      </form>  
    </div>
    <div class="text-white text-xl mx-1 my-auto">
     <ul class="flex list-style-none">
      <li class="mx-1"><a href="/product/create">add</a></li>
      <li class="mx-1"><a href="/order">order</a></li>
      <li class="mx-1"><a href="/about">contact us</a></li>   
     </ul>   
    </div>
    <div class="flex mx-2">
      <div>
       <cart-component :userId="userId"/>   
      </div>
      <div>
       <notifications-component :userId="userId"/>   
      </div>   
    </div>
    <div> 
  </div>  
   <div>
    <div class="my-auto">
     <button @click="userDropdownMenu=true">
      <span class="text-xl text-white">{{user.name}}</span>
     </button>   
    </div>   
   </div>  
     <div v-if="userDropdownMenu" class="fixed z-20 text-2xl bg-gray-50 rounded-md">
      <ul>
       <li class="hover:bg-gray-300 p-2"><a href="/logout">logout</a></li>
       <li class="hover:bg-gray-300 p-2"><a href="/profile/edit">my profile</a></li>
       <li class="hover:bg-gray-300 p-2"><a href="/product/create">add product</a></li>
       <li class="hover:bg-gray-300 p-2"><a href="/order">order</a></li>
       <li class="hover:bg-gray-300 p-2"><a href="/about">contact us</a></li>  
      </ul>
     </div>
    </div> 
    <!-- <div class="lg:none xl:none">
      <button @click="navWidth=50">
      <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-10 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
    </div> -->
    <div v-if="userDropdownMenu" @click="userDropdownMenu=false" class="absolute z-10 -inset-y-full -inset-x-0 bg-black opacity-50"></div>
   </div>
</template>
<script>
export default {
   props:['userId'],
   data(){
    return{
      user:{},
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

   }
}
</script>