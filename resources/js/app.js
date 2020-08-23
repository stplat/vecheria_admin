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


const app = new Vue({
  el: '#app',
  VtTables,
  Union,
  store
});
