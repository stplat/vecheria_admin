<template>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <alert className="success" v-if="result.show" v-html="result.text"/>
          <alert v-for="(error, i) in errors" :key="i" v-html="error"/>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="category" class="text-muted"><strong>Категория:</strong></label>
            <select class="form-control" id="category" v-model="category">
              <option disabled value>Выберите один из вариантов</option>
              <option :value="category.name" v-for="(category, key) in categories" :key="key">{{ category.name }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group" v-if="category">
            <label for="subcategory" class="text-muted"><strong>Подкатегория:</strong></label>
            <select class="form-control" multiple id="subcategory" v-model="data.category_id">
              <option disabled value>Выберите один из вариантов</option>
              <option :value="subcategory.category_id" v-for="(subcategory, key) in subcategories" :key="key">{{ subcategory.name_2st }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="name" class="text-muted"><strong>Название:</strong></label>
        <input id="name" class="form-control" v-model="data.name">
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="article" class="text-muted"><strong>Артикул:</strong></label>
            <input id="article" class="form-control" v-model="data.article">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="available" class="text-muted"><strong>Наличие:</strong></label>
            <input id="available" class="form-control" v-model="data.available">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="price" class="text-muted"><strong>Цена:</strong></label>
            <input id="price" class="form-control" v-model="data.price">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="manufacturer" class="text-muted"><strong>Производитель:</strong></label>
            <input id="manufacturer" class="form-control" v-model="data.manufacturer">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="material" class="text-muted"><strong>Материал:</strong></label>
            <input id="material" class="form-control" v-model="data.material">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="technic" class="text-muted"><strong>Техника:</strong></label>
            <input id="technic" class="form-control" v-model="data.technic">
          </div>
        </div>
      </div>
      <product-create-photo></product-create-photo>
      <div class="text-right mt-4">
        <button class="btn btn-primary" @click="create" :disabled="isLoading">
          <span v-show="isLoading" class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
          Создать товар
        </button>
      </div>
    </div>
  </div>
</template>

<script>
  import ProductCreatePhoto from './ProductCreatePhoto';

  export default {
    components: {
      ProductCreatePhoto
    },
    data() {
      return {
        data: {
          category_id: '',
          name: '',
          article: '',
          available: '',
          price: '',
          manufacturer: '',
          material: '',
          technic: '',
          image_path: ''
        },
        upload: {
          name: '',
          file: ''
        },
        category: '',
        isLoading: false,
        errors: [],
        messages: [
          { 'category_id.required': 'Поле <strong>Категория</strong> обязательно для заполнения' },
          { 'name.required': 'Поле <strong>Название</strong> обязательно для заполнения' },
          { 'manufacturer.required': 'Поле <strong>Производитель</strong> обязательно для заполнения' },
          { 'article.required': 'Поле <strong>Артикул</strong> обязательно для заполнения' },
          { 'available.required': 'Поле <strong>Наличие</strong> обязательно для заполнения' },
          { 'price.required': 'Поле <strong>Цена</strong> обязательно для заполнения' },
          { 'material.required': 'Поле <strong>Материал</strong> обязательно для заполнения' },
          { 'technic.required': 'Поле <strong>Техника</strong> обязательно для заполнения' },
          { 'image_path.required': 'Поле <strong>Фотография</strong> обязательно для заполнения' }
        ],
        result: {
          show: false,
          text: ''
        }
      }
    },
    methods: {
      create() {
        if (this.validate()) {
          this.isLoading = true;

          // this.$store.dispatch('User/createUser', { user_login, user_pass, role_id }).then((res) => {
          //   if (!res.hasOwnProperty('errors')) {
          //     this.$emit('getResult', `Пользователь <strong>${user_login}</strong> успешно создан!`);
          //     this.$emit('close');
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

        if (this.data.category_id === '') this.errors.push(getMessage('category_id.required'));
        if (this.data.name === '') this.errors.push(getMessage('name.required'));
        if (this.data.article === '') this.errors.push(getMessage('article.required'));
        if (this.data.available === '') this.errors.push(getMessage('available.required'));
        if (this.data.price === '') this.errors.push(getMessage('price.required'));
        if (this.data.manufacturer === '') this.errors.push(getMessage('manufacturer.required'));
        if (this.data.material === '') this.errors.push(getMessage('material.required'));
        if (this.data.technic === '') this.errors.push(getMessage('technic.required'));
        if (this.data.image_path === '') this.errors.push(getMessage('image_path.required'));

        return !this.errors.length;
      }
    },
    computed: {
      categories() {
        return _.uniqBy(this.$store.getters['Product/getCategories'], 'name');
      },
      subcategories() {
        return this.$store.getters['Product/getCategories'].filter(item => item.name === this.category);
      }
    }
  }
</script>
<style lang="scss" scoped>

</style>
