import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

/* Модули redux */
import Product from './modules/Product';

export default new Vuex.Store({
  modules: {
    Product
  },
  state: {
    // requestPath: 'http://lkstops3.optimagp66.ru'
    requestPath: '',
  }
});
