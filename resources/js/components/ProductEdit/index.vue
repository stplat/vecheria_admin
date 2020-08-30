<template>
  <main>
    <div class="row">
      <div class="col-md-12">
        <alert className="success" v-if="result.text" v-html="result.text"/>
        <alert v-for="(error, i) in errors" :key="i" v-html="error"/>
      </div>
    </div>
    <tab :tabs="mainTabs" :activeTab.sync="activeTab" :isLoading="isLoading" :key="reset">
      <template v-slot:required>
        <product-edit-required
          v-bind.sync="data"
        ></product-edit-required>
      </template>
      <template v-slot:optional>
        <product-create-optional
          :weight.sync="data.weight"
          :dimension.sync="data.dimension"
          :video.sync="data.video"
          :comment.sync="data.comment"
          :description.sync="data.description"
          :similar_product.sync="data.similar_product"
        ></product-create-optional>
      </template>
    </tab>
    <div class="text-right mt-4">
      <button class="btn btn-primary" @click="edit" :disabled="isLoading">
        <span v-show="isLoading" class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
        Добавить товар
      </button>
    </div>
  </main>
</template>

<script>
  import ProductEditRequired from './ProductEditRequired';
  import ProductCreateOptional from './ProductCreateOptional';

  export default {
    components: {
      ProductEditRequired,
      ProductCreateOptional
    },
    data() {
      return {
        data: {
          categories: [],
          name: '',
          article: '',
          available: '',
          price: '',
          manufacturer: '',
          material: '',
          technic: '',
          files: [],
          meta_keywords: '',
          meta_description: '',
          meta_title: '',

          weight: '',
          dimension: '',
          video: '',
          comment: '',
          description: '',
          similar_product: []
        },
        activeTab: '',
        mainTabs: [
          { name: 'Обязательные поля', active: true, slot: 'required' },
          { name: 'Необязательные поля', active: false, slot: 'optional' }
        ],
        isLoading: false,
        errors: [],
        messages: [
          { 'categories.required': 'Поле <strong>Категория</strong> обязательно для заполнения' },
          { 'name.required': 'Поле <strong>Название</strong> обязательно для заполнения' },
          { 'manufacturer.required': 'Поле <strong>Производитель</strong> обязательно для заполнения' },
          { 'article.required': 'Поле <strong>Артикул</strong> обязательно для заполнения' },
          { 'available.required': 'Поле <strong>Наличие</strong> обязательно для заполнения' },
          { 'price.required': 'Поле <strong>Цена</strong> обязательно для заполнения' },
          { 'material.required': 'Поле <strong>Материал</strong> обязательно для заполнения' },
          { 'technic.required': 'Поле <strong>Техника</strong> обязательно для заполнения' },
          { 'files.required': 'Поле <strong>Изображение</strong> обязательно для заполнения' },
          { 'meta_keywords.required': 'Поле <strong>Мета keywords</strong> обязательно для заполнения' },
          { 'meta_description.required': 'Поле <strong>Мета description</strong> обязательно для заполнения' },
          { 'meta_title.required': 'Поле <strong>Мета title</strong> обязательно для заполнения' }
        ],
        result: {
          text: '',
          timer: 0
        },
        reset: true
      }
    },
    props: {
      categories: {
        type: Array,
        required: true
      },
      product: {
        type: Object,
        required: true
      }
    },
    mounted() {
      this.$store.commit('Product/setCategories', this.categories);
      this.$store.commit('Product/setProduct', this.product);
    },
    methods: {
      edit() {
        this.$store.dispatch('Product/editProduct', this.data);
        if (this.validate()) {
          // this.isLoading = true;

          // this.$store.dispatch('Product/editProduct', this.data).then((res) => {
          //   if (!res.hasOwnProperty('errors')) {
          //     this.result.text = `Товар <strong>${ this.data.name }</strong> успешно создан!`;
          //     clearTimeout(this.result.timer);
          //     this.result.timer = setTimeout(() => this.result.text = '', 3000);
          //     this.reset = !this.reset;
          //   }
          //   this.errors = res.errors;
          //   this.isLoading = false;
          // });
        }
      },
      validate() {
        this.errors = [];

        const getMessage = (key) => {
          return this.messages.filter(item => item.hasOwnProperty(key))[0][key];
        };

        if (!this.data.categories.length) this.errors.push(getMessage('categories.required'));
        if (this.data.name === '') this.errors.push(getMessage('name.required'));
        if (this.data.article === '') this.errors.push(getMessage('article.required'));
        if (this.data.available === '') this.errors.push(getMessage('available.required'));
        if (this.data.price === '') this.errors.push(getMessage('price.required'));
        if (this.data.manufacturer === '') this.errors.push(getMessage('manufacturer.required'));
        if (this.data.material === '') this.errors.push(getMessage('material.required'));
        if (this.data.technic === '') this.errors.push(getMessage('technic.required'));
        if (!this.data.files.length) this.errors.push(getMessage('files.required'));
        if (this.data.meta_keywords === '') this.errors.push(getMessage('meta_keywords.required'));
        if (this.data.meta_description === '') this.errors.push(getMessage('meta_description.required'));
        if (this.data.meta_title === '') this.errors.push(getMessage('meta_title.required'));

        return !this.errors.length;
      }
    },

  }
</script>

<style lang="scss" scoped>
</style>
