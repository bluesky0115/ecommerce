import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);
export default new VueRouter({
  base_url:'/products',
  mode:'history',
  routes:[
    {
      path:'/:category',
      name:'category',
      component:()=>require('./components/categoryComponent')
    }
  ]
})
