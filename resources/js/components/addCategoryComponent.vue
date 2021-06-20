<template>
  <div>
   <button @click="addCategory">add category</button> 
  <div v-if="categoryPopup" class="fixed z-20 sm:w-full md:w-full">
    <form @submit.prevent="createCategory">
      <input type="text" v-model="categoryName" placeholder="category name" required class="">
      <input type="submit" value="add category" class="">
    </form>
  </div>
  <div v-if="categoryPopup" @click="categoryPopup=false" class="z-10 absolute -inset-full bg-black opacity-50"></div>
  </div>
</template>
<script>
export default {
  props:['userId'],
  data(){
    return{
      categoryName:'',
      categoryPopup:false
    }
  },
  mounted(){
    axios.get('/isAdmin',{params:{userId:this.userId}})
    .then(res=>{
      this.isAdmin=res.data.isAdmin;
    });
  },
  methods:{
    addcategory(){
      if(this.isAdmin){
       axios.post('/category/create',{categoryName:this.categoryName})
       .then(res=>{
        this.categoryPopup=false;
      });
      }
      else{
        alert('only adminstrators can add new category');
      }
    }
  }
}
</script>