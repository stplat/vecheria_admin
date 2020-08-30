<template>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <alert className="info">ID: <strong>{{ product.product_id }}</strong></alert>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="category" class="text-muted"><strong>Категория:</strong></label>
            <select class="form-control" id="category" v-model="category">
              <option disabled value>Выберите один из вариантов</option>
              <option :value="item.name" v-for="(item, key) in categories" :key="key">{{ item.name }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group" v-show="category">
            <label for="subcategory" class="text-muted"><strong>Подкатегория:</strong></label>
            <select class="form-control" multiple id="subcategory" v-model="subcategory">
              <option disabled value>Выберите один из вариантов</option>
              <option :value="item.category_id" v-for="(item, key) in subcategories" :key="key" :hidden="!item.hidden">{{ item.name_2st }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="name" class="text-muted"><strong>Название:</strong></label>
        <input id="name" class="form-control" v-model="name">
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="article" class="text-muted"><strong>Артикул:</strong></label>
            <input id="article" class="form-control" v-model="article">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="available" class="text-muted"><strong>Наличие:</strong></label>
            <input id="available" class="form-control" v-model="available">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="price" class="text-muted"><strong>Цена:</strong></label>
            <input id="price" class="form-control" v-prevent-number v-model.number="price">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="manufacturer" class="text-muted"><strong>Производитель:</strong></label>
            <input id="manufacturer" class="form-control" v-model="manufacturer">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="material" class="text-muted"><strong>Материал:</strong></label>
            <input id="material" class="form-control" v-model="material">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="technic" class="text-muted"><strong>Техника:</strong></label>
            <input id="technic" class="form-control" v-model="technic">
          </div>
        </div>
      </div>
      <product-create-photo v-model="files" :current-files="currentFiles" @removePhoto=""></product-create-photo>
      <div class="form-group position-relative">
        <label for="meta_keywords" class="text-muted"><strong>Meta Keywords:</strong></label>
        <input id="meta_keywords" class="form-control" v-model="meta_keywords">
      </div>
      <div class="form-group position-relative">
        <label for="meta_description" class="text-muted"><strong>Meta Description:</strong></label>
        <input id="meta_description" class="form-control" v-model="meta_description">
      </div>
      <div class="form-group position-relative">
        <label for="meta_title" class="text-muted"><strong>Meta Title:</strong></label>
        <input id="meta_title" class="form-control" v-model="meta_title">
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
        subcategory: [],
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
        category: '',
        currentFiles: [],
        currentSubcategory: []
      }
    },
    methods: {
      updateFiles(value) {
        this.$emit('update:files', value)
      }
    },
    computed: {
      categories() {
        return _.uniqBy(this.$store.getters['Product/getCategories'], 'name');
      },
      subcategories() {
        return this.$store.getters['Product/getCategories'].map(item => {
          item.hidden = item.name === this.category;
          return item;
        });
      },
      product() {
        const product = this.$store.getters['Product/getProduct'];
        this.subcategory = this.currentSubcategory = product.hasOwnProperty('categories') ? product.categories.map(item => item.category_id) : [];
        this.category =  product.hasOwnProperty('categories') ? product.categories[0].name : [];
        this.name = product.name;
        this.article = product.article;
        this.available = product.available;
        this.price = product.price;
        this.manufacturer = product.manufacturer;
        this.material = product.material;
        this.technic = product.technic;
        this.meta_keywords = product.meta_keywords;
        this.meta_description = product.meta_description;
        this.meta_title = product.meta_title;
        this.currentFiles = product.hasOwnProperty('image_path') ? product.image_path.split(';') : [];

        return product;
      }
    },
    watch: {
      category() {
        // this.subcategory = this.currentSubcategory;
      },
      subcategory() {
        this.$emit('update:categories', this.subcategory);
      },
      name() {
        this.$emit('update:name', this.name);
      },
      files() {
        this.$emit('update:files', this.files);
      },
      article() {
        this.$emit('update:article', this.article);
      },
      available() {
        this.$emit('update:available', this.available);
      },
      price() {
        this.$emit('update:price', this.price);
      },
      manufacturer() {
        this.$emit('update:manufacturer', this.manufacturer);
      },
      material() {
        this.$emit('update:material', this.material);
      },
      technic() {
        this.$emit('update:technic', this.technic);
      },
      meta_keywords() {
        this.$emit('update:meta_keywords', this.meta_keywords);
      },
      meta_description() {
        this.$emit('update:meta_description', this.meta_description);
      },
      meta_title() {
        this.$emit('update:meta_title', this.meta_title);
      }
    },
    mounted() {

    }
  }
</script>
<style lang="scss" scoped>

</style>
