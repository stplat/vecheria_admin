<template>
  <div class="row">
    <div class="col-md-12">
      <!--          <alert :className="result.className" v-show="result.show">Пользователь <strong>{{ result.name }}</strong> успешно {{ result.text }}!</alert>-->
      <div class="card mb-1">
        <h4 class="card-header">Список продукции</h4>
        <div class="card-body product">
          <v-client-table :data="table.data" :columns="table.columns" :options="table.options">
            <template v-slot:afterLimit>
              <a :href="assetBase + '/products/create'" class="btn btn-primary">Добавить</a>
            </template>
            <template v-slot:actions="props">
              <a class="fa fa-edit" href="" @click.prevent="modal.edit.show = true; modal.edit.id = props.row.id">
                <unicon name="pen" fill="royalblue"/>
              </a>
              <a class="fa fa-edit" href="" @click.prevent="modal.delete.show = true; modal.delete.id = props.row.id">
                <unicon name="trash-alt" fill="royalblue"/>
              </a>
            </template>
          </v-client-table>
        </div>
      </div>
      <product-create v-if="modal.create.show" @close="modal.create.show = false"></product-create>
      <!--      <users-edit :id="modal.edit.id" v-if="modal.edit.show" @close="modal.edit.show = false"></users-edit>-->
      <!--      <users-delete :id="modal.delete.id" v-if="modal.delete.show" @close="modal.delete.show = false"></users-delete>-->
    </div>
  </div>
</template>

<script>
  import ProductCreate from './ProductCreate';

  export default {
    components: {
      ProductCreate
    },
    data() {
      return {
        modal: {
          create: {
            show: false
          }
        }
      }
    },
    props: {
      products: {
        type: Array,
        required: true
      },
      categories: {
        type: Array,
        required: true
      }
    },
    mounted() {
      this.$store.commit('Product/setCategories', this.categories);
      this.$store.commit('Product/setProducts', this.products);
    },
    computed: {
      table() {
        const headings = {
          key: '№',
          article: 'Артикул',
          name: 'Название',
          category: 'Категория',
          subcategories: 'Подкатегории',
          manufacturer: 'Производитель',
          material: 'Материал',
          technic: 'Техника',
          price: 'Цена, руб.',
          actions: 'Действия'
        };

        const data = this.$store.getters['Product/getProducts'].map((product, i) => ( {
          key: i + 1,
          article: product.article,
          name: product.name,
          category: product.categories[0].name,
          subcategories: product.categories.map(item => item.name_2st).join(', '),
          manufacturer: product.manufacturer,
          material: product.material,
          technic: product.technic,
          price: product.price,
          actions: ''
        } ));

        return { data, options: { headings, _data: data }, columns: Object.keys(headings) };
      }
    }
  }
</script>

<style lang="scss">
  .product .VueTables__table {
    table-layout: fixed;

    thead tr th:nth-child(1) {
      width: 70px;
    }

    thead tr th:nth-child(2) {
      width: 115px;
    }
  }

</style>
