require('./assets/bootstrap');
require('./assets/modernizr');
require('./assets/aside-slide');
require('./assets/login-dropdown');

import Vue from 'vue';
import store from './stores';

/* Mixins */
Vue.mixin(require('./mixins/variables').default);
Vue.mixin(require('./mixins/helpers').default);

/* Plugins */
import VtTables from './plugins/VtTables';
import Union from './plugins/Unicon';

/* Components */
Vue.component('alert', require('./components/Alert').default);
Vue.component('popup', require('./components/Popup').default);
Vue.component('preloader', require('./components/Preloader').default);
Vue.component('product', require('./components/Product').default);
Vue.component('product-create', require('./components/ProductCreate').default);
Vue.component('product-edit', require('./components/ProductEdit').default);
Vue.component('tab', require('./components/Tab').default);

const app = new Vue({
  el: '#app',
  VtTables,
  Union,
  store
});
