import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);
import categoryComponent from './components/categoryComponent'
export default new VueRouter({
  mode:'history',
  routes:[
    {
      path:'/products/:categoryName',
      name:'category',
      component:categoryComponent
    }
  ]
})
