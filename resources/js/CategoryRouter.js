import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);

const router=new VueRouter({
  base_url:'/products',
  mode:'history',
  routes:[
    {
      path:'/all',
      name:'all',
      component:()=>require('./components/productsComponent')
    },
    {
      path:'/:category',
      name:'category',
      component:()=>require('./components/categoryComponent')
    },
    {
      path:'/other',
      name:'other',
      component:()=>require('./components/otherComponent')
    },
  ]
})