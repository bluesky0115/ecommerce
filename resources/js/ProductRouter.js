import Vue from 'vue'
import VueRouter from 'vue=router'
Vue.use(VueRouter);

const router=new VueRouter({
  base_url:'/products',
  mode:'history',
  routes:[
    {
      path:':category',
      name:':category',
      component:()=>require('./components/productsComponent')
    },
  ]
})