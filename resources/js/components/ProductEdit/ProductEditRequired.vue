<template>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="category" class="text-muted"><strong>Категория:</strong></label>
            <select class="form-control" id="category" :value="category" @input="$emit('update:category', $event.target.value)">
              <option disabled value>Выберите один из вариантов</option>
              <option :value="item.name" v-for="(item, key) in allCategories" :key="key">{{ item.name }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group" v-show="category">
            <label for="subcategory" class="text-muted"><strong>Подкатегория:</strong></label>
            <select class="form-control" multiple id="subcategory" v-model="subcategory" @input="$emit('update:categories', subcategory)">
              <option disabled value>Выберите один из вариантов</option>
              <option :value="item.category_id" v-for="(item, key) in allSubcategories" :key="key" :hidden="!item.hidden">{{ item.name_2st }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="name" class="text-muted"><strong>Название:</strong></label>
        <input id="name" class="form-control" :value="name" @input="$emit('update:name', $event.target.value)">
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="article" class="text-muted"><strong>Артикул:</strong></label>
            <input id="article" class="form-control" :value="article" @input="$emit('update:article', $event.target.value)">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="available" class="text-muted"><strong>Наличие:</strong></label>
            <input id="available" class="form-control" :value="available" @input="$emit('update:available', $event.target.value)">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="price" class="text-muted"><strong>Цена:</strong></label>
            <input id="price" class="form-control" v-prevent-number :value.number="price" @input="$emit('update:price', $event.target.value)">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="manufacturer" class="text-muted"><strong>Производитель:</strong></label>
            <input id="manufacturer" class="form-control" :value="manufacturer" @input="$emit('update:manufacturer', $event.target.value)">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="material" class="text-muted"><strong>Материал:</strong></label>
            <input id="material" class="form-control" :value="material" @input="$emit('update:material', $event.target.value)">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="technic" class="text-muted"><strong>Техника:</strong></label>
            <input id="technic" class="form-control" :value="technic" @input="$emit('update:technic', $event.target.value)">
          </div>
        </div>
      </div>
      <product-edit-photo v-model="localFiles" :current-files="currentFiles" @removePhoto="removeCurrentFiles"></product-edit-photo>
      <div class="form-group position-relative">
        <label for="meta_keywords" class="text-muted"><strong>Meta Keywords:</strong></label>
        <input id="meta_keywords" class="form-control" :value="meta_keywords" @input="$emit('update:meta_keywords', $event.target.value)">
      </div>
      <div class="form-group position-relative">
        <label for="meta_description" class="text-muted"><strong>Meta Description:</strong></label>
        <input id="meta_description" class="form-control" :value="meta_description" @input="$emit('update:meta_description', $event.target.value)">
      </div>
      <div class="form-group position-relative">
        <label for="meta_title" class="text-muted"><strong>Meta Title:</strong></label>
        <input id="meta_title" class="form-control" :value="meta_title" @input="$emit('update:meta_title', $event.target.value)">
      </div>
    </div>
  </div>
</template>

<script>
  import ProductEditPhoto from './ProductEditPhoto';

  export default {
    components: {
      ProductEditPhoto
    },
    data() {
      return {
        subcategory: [],
        localFiles: []
      }
    },
    props: {
      id: { type: Number },
      category: { type: String },
      categories: { type: Array },
      name: { type: String },
      article: { type: String },
      available: { type: String },
      price: { type: Number },
      manufacturer: { type: String },
      material: { type: String },
      technic: { type: String },
      files: { type: Array },
      meta_keywords: { type: String },
      meta_description: { type: String },
      meta_title: { type: String },
      currentFiles: { type: Array },
    },
    methods: {
      removeCurrentFiles(key) {
        this.$emit('removeCurrentFiles', key);
      }
    },
    computed: {
      allCategories() {
        return _.uniqBy(this.$store.getters['Product/getCategories'], 'name');
      },
      allSubcategories() {
        return this.$store.getters['Product/getCategories'].map(item => {
          item.hidden = item.name === this.category;
          return item;
        });
      }
    },
    watch: {
      categories() {
        this.subcategory = this.categories;
      },
      localFiles() {
        this.$emit('update:files', this.localFiles);
      }
    }
  }
</script>
<style lang="scss" scoped>

</style>
