<template>
  <main>
    <tab :tabs="mainTabs" :activeTab.sync="activeTab">
      <template v-slot:required>
        <product-create-required></product-create-required>
      </template>
      <template v-slot:optional>
        <product-create-optional></product-create-optional>
      </template>
    </tab>
    <div class="card mt-4" v-if="activeTab === 'optional'">
      <h4 class="card-header">Метаданные для браузеров</h4>
      <div class="card-body">
        <div class="form-group position-relative">
          <label for="meta_keywords" class="text-muted"><strong>Meta Keywords:</strong></label>
          <input id="meta_keywords" class="form-control" v-model="data.meta_keywords">
        </div>
        <div class="form-group position-relative">
          <label for="meta_description" class="text-muted"><strong>Meta Description:</strong></label>
          <input id="meta_description" class="form-control" v-model="data.meta_description">
        </div>
        <div class="form-group position-relative">
          <label for="meta_title" class="text-muted"><strong>Meta Title:</strong></label>
          <input id="meta_title" class="form-control" v-model="data.meta_title">
        </div>
      </div>
    </div>
  </main>
</template>

<script>
  import ProductCreateRequired from './ProductCreateRequired';
  import ProductCreateOptional from './ProductCreateOptional';

  export default {
    components: {
      ProductCreateRequired,
      ProductCreateOptional
    },
    data() {
      return {
        data: {
          meta_keywords: '',
          meta_description: '',
          meta_title: ''
        },
        activeTab: '',
        mainTabs: [
          { name: 'Обязательные поля', active: true, slot: 'required' },
          { name: 'Необязательные поля', active: false, slot: 'optional' }
        ]
      }
    },
    props: {
      categories: {
        type: Array,
        required: true
      }
    },
    mounted() {
      this.$store.commit('Product/setCategories', this.categories);
    }
  }
</script>

<style lang="scss" scoped>
</style>
