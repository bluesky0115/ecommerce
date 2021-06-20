import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

const store=new Vuex.store({
  state:{
   products:[]
  },
  mutations:{
    addProduct(state,payload){
             
    },
    removeProduct(state,payload){
      let removedProduct=state.products.find(product=>product.id==payload.id);
      let removedProductId=removedProduct.id;
      axios.post('/product/delete',{removedProductId:this.removedProductId})
      .then(res=>{
        let index=state.products.findIndex(state.products.find(product=>product.id==removedProduct.id))
        this.products.splice(index,1);
      });
    }
  },
  getters:{
    products(state,context){
      axios.get('/products')
      .then(res=>{
        state.products=res.data.products;
      })
    }
  },
  actions:{

  }
}
)