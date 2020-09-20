<template>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group position-relative">
            <label for="weight" class="text-muted"><strong>Вес:</strong></label>
            <input id="weight" class="form-control" :value="weight" @input="$emit('update:weight', $event.target.value)">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group position-relative">
            <label for="dimension" class="text-muted"><strong>Размеры:</strong></label>
            <input id="dimension" class="form-control" :value="dimension" @input="$emit('update:dimension', $event.target.value)">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group position-relative">
            <label for="video" class="text-muted"><strong>Ссылка на видео:</strong></label>
            <input id="video" class="form-control" :value="video" @input="$emit('update:video', $event.target.value)">
          </div>
        </div>
      </div>
      <div class="form-group position-relative">
        <label for="comment" class="text-muted"><strong>Комментарии:</strong></label>
        <textarea id="comment" class="form-control" style="resize: none" :value="comment" @input="$emit('update:comment', $event.target.value)"></textarea>
      </div>
      <div class="form-group position-relative">
        <label for="description" class="text-muted"><strong>Описание:</strong></label>
        <textarea id="description" class="form-control" style="resize: none" :value="description" @input="$emit('update:description', $event.target.value)"></textarea>
      </div>
      <div class="form-group position-relative">
        <div class="text-muted"><strong>Похожие товары:</strong></div>
        <v-client-table :data="table.data" :columns="table.columns" :options="table.options">
          <template v-slot:check="props">
            <div class="checkbox">
              <input type="checkbox" hidden :id="'field' + props.row.id" :value="props.row.id"
                     v-model="localSimilarProduct"
                     @change="$emit('update:similar_product', localSimilarProduct)"/>
              <label :for="'field' + props.row.id"></label>
            </div>
          </template>
        </v-client-table>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        localSimilarProduct: []
      }
    },
    props: {
      weight: { type: String },
      dimension: { type: String },
      video: { type: String },
      comment: { type: String },
      description: { type: String },
      similar_product: { type: Array }
    },
    watch: {
      similar_product() {
        this.localSimilarProduct = this.similar_product;
      }
    },
    computed: {
      table() {
        const headings = {
          check: 'Выбрать',
          article: 'Артикул',
          name: 'Название',
          category: 'Категория',
          subcategories: 'Подкатегории',
          manufacturer: 'Производитель',
          material: 'Материал',
          technic: 'Техника',
          price: 'Цена, руб.'
        };

        const data = this.$store.getters['Product/getProducts'].map((product, i) => ( {
          id: product.product_id,
          article: product.article,
          name: product.name,
          category: product.categories[0].name,
          subcategories: product.categories.map(item => item.name_2st).join(', '),
          manufacturer: product.manufacturer,
          material: product.material,
          technic: product.technic,
          price: product.price
        } ));

        return { data, options: { headings, _data: data }, columns: Object.keys(headings) };
      }
    }

  }
</script>
