import axios from 'axios';

export default {
  namespaced: true,
  state: {
    product: {},
    products: [],
    categories: []
  },
  actions: {
    /* Получение товара */
    async updateProduct({ commit }, payload) {
      let { id } = payload;
      const res = await axios.get(this.state.requestPath + '/users/' + id).catch(err => console.log('In user/updateProduct - ' + err));

      if (!res.data.errors) {
        commit('setProduct', res.data);
        return res.data;
      } else {
        return { errors: Object.values(res.data.errors).map(item => item[0]) };
      }
    },
    /* Создание пользователя */
    // let {
    // category_id, meta_keywords, meta_description, meta_title, article, name, available, price, weight, dimensions,
    // manufacturer, material, technic, comment, description, video, image_path, similar_product_id
    // } = payload;
    async createProduct({ commit }, payload) {
      const res = await axios.post(this.state.requestPath + '/admin/products', payload).catch(err => console.log('In product/createProduct - ' + err));
      console.log(res)
      if (!res.data.errors) {
        commit('setProducts', res.data);
        return res.data;
      } else {
        return { errors: Object.values(res.data.errors).map(item => item[0]) };
      }
    }

  },
  mutations: {
    setProduct: (state, obj) => state.product = obj,
    setProducts: (state, array) => state.products = array,
    setCategories: (state, array) => state.categories = array
  },
  getters: {
    getProduct: (state) => state.product,
    getProducts: (state) => state.products,
    getCategories: (state) => state.categories
  }
};
