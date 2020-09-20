import axios from 'axios';
import { serialize } from '../../mixins/helpers';

export default {
  namespaced: true,
  state: {
    product: {},
    products: [],
    categories: []
  },
  actions: {
    /* Получение списка категорий */
    async updateCategories({ commit }, payload) {
      const res = await axios.get(this.state.requestPath + '/admin/products/categories').catch(err => console.log('In product/updateCategories - ' + err));
      return !res.data.errors ? res.data : { errors: Object.values(res.data.errors).map(item => item[0]) };
    },

    /* Получение товара */
    async updateProduct({ commit }, payload) {
      let { id } = payload;
      const res = await axios.get(this.state.requestPath + '/admin/products/' + id).catch(err => console.log('In product/updateProduct - ' + err));

      if (!res.data.errors) {
        commit('setProduct', res.data);
        return res.data;
      } else {
        return { errors: Object.values(res.data.errors).map(item => item[0]) };
      }
    },
    /* Создание пользователя */
    async createProduct({ commit }, payload) {
      const formData = new FormData();
      for (let param in payload) {
        if (payload.hasOwnProperty(param)) {
          if (param === 'files') {
            for (let file in payload['files']) {
              if (payload['files'].hasOwnProperty(file)) {
                formData.append('files[' + file + ']', payload[param][file]);
              }
            }
          } else if (param === 'categories') {
            payload['categories'].forEach((item, key) => {
              formData.append('categories[' + key + ']', item);
            });
          } else if (param === 'similar_product') {
            payload['similar_product'].forEach((item, key) => {
              formData.append('similar_product[' + key + ']', item);
            });
          } else {
            formData.append(param, payload[param]);
          }
        }
      }

      const res = await axios.post(this.state.requestPath + '/admin/products', formData).catch(err => console.log('In product/createProduct - ' + err));

      if (!res.data.errors) {
        commit('setProducts', res.data);
        return res.data;
      } else {
        return { errors: Object.values(res.data.errors).map(item => item[0]) };
      }
    },
    /* Редактирование пользователя */
    async editProduct({ commit }, payload) {
      const formData = new FormData();
      for (let param in payload) {
        if (payload.hasOwnProperty(param)) {
          if (param === 'files') {
            payload['files'].forEach((item, key) => {
              typeof item === 'string'
                ? formData.append('currentFiles[' + key + ']', item)
                : formData.append('files[' + key + ']', item);
            });
          } else if (param === 'categories') {
            payload['categories'].forEach((item, key) => {
              formData.append('categories[' + key + ']', item);
            });
          } else if (param === 'similar_product') {
            payload['similar_product'].forEach((item, key) => {
              formData.append('similar_product[' + key + ']', item);
            });
          } else {
            formData.append(param, payload[param]);
          }
        }
      }
      const res = await axios.post(this.state.requestPath + '/admin/products/update', formData).catch(err => console.log('In product/editProduct - ' + err));

      if (!res.data.errors) {
        commit('setProduct', res.data);
        return res.data;
      } else {
        return { errors: Object.values(res.data.errors).map(item => item[0]) };
      }
    },

    /* Удаление товара */
    async deleteProduct({ commit }, payload) {
      let { id } = payload;
      const res = await axios.delete(this.state.requestPath + '/admin/products/' + id).catch(err => console.log('In product/deleteProduct - ' + err));

      if (!res.data.errors) {
        commit('setProducts', res.data);
        return res.data;
      } else {
        return { errors: Object.values(res.data.errors).map(item => item[0]) };
      }
    },
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
