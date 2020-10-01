<template>
  <div class="row">
    <div class="col-md-12">
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
            <div class="text-muted"><strong>Подкатегория:</strong></div>
            <ul class="form-select-multi">
              <li v-for="(item, key) in subcategories" :key="key">
                <input type="checkbox"
                       :id="'subcategory_' + item.category_id"
                       :value="item.category_id"
                v-model="subcategory">
                <label :for="'subcategory_' + item.category_id" >{{ item.name_2st }}</label>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="name" class="text-muted"><strong>Название:</strong></label>
        <input id="name" class="form-control" @input="$emit('update:name', $event.target.value)">
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="article" class="text-muted"><strong>Артикул:</strong></label>
            <input id="article" class="form-control" @input="$emit('update:article', $event.target.value)">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="available" class="text-muted"><strong>Наличие:</strong></label>
            <input id="available" class="form-control" @input="$emit('update:available', $event.target.value)">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="price" class="text-muted"><strong>Цена:</strong></label>
            <input id="price" class="form-control" v-prevent-number @input="$emit('update:price', $event.target.value)">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="manufacturer" class="text-muted"><strong>Производитель:</strong></label>
            <input id="manufacturer" class="form-control" @input="$emit('update:manufacturer', $event.target.value)">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="material" class="text-muted"><strong>Материал:</strong></label>
            <input id="material" class="form-control" @input="$emit('update:material', $event.target.value)">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="technic" class="text-muted"><strong>Техника:</strong></label>
            <input id="technic" class="form-control" @input="$emit('update:technic', $event.target.value)">
          </div>
        </div>
      </div>
      <product-create-photo @updateFiles="updateFiles"></product-create-photo>
      <div class="form-group position-relative">
        <label for="meta_keywords" class="text-muted"><strong>Meta Keywords:</strong></label>
        <input id="meta_keywords" class="form-control" @input="$emit('update:meta_keywords', $event.target.value)">
      </div>
      <div class="form-group position-relative">
        <label for="meta_description" class="text-muted"><strong>Meta Description:</strong></label>
        <input id="meta_description" class="form-control" @input="$emit('update:meta_description', $event.target.value)">
      </div>
      <div class="form-group position-relative">
        <label for="meta_title" class="text-muted"><strong>Meta Title:</strong></label>
        <input id="meta_title" class="form-control" @input="$emit('update:meta_title', $event.target.value)">
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
        category: ''
      }
    },
    watch: {
      subcategory() {
        this.$emit('update:categories', this.subcategory);
      }
    },
    methods: {
      changeSubcategory(e) {
        console.log(window.getSelection())
      },
      updateFiles(value) {
        this.$emit('update:files', value)
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
