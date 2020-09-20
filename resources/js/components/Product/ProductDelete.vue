<template>
  <popup @close="$emit('close')" :isLoading="isLoading">
    <template v-slot:header>Удаление товара</template>
    <template v-slot:body>
      <div class="row">
        <div class="col-md-12">
          <alert className="info">ID: <strong>{{ id }}</strong>, Название: <strong>{{ name }}</strong></alert>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mt-3">
          <h5>Вы уверены, что хотите удалить этот товар?</h5>
        </div>
      </div>
    </template>
    <template v-slot:footer>
      <button class="btn btn-light ml-auto" @click="$emit('close')">Отменить</button>
      <button class="btn btn-danger ml-3" @click="remove">Удалить</button>
    </template>
  </popup>
</template>

<script>
  export default {
    data() {
      return {
        name: '',
        isLoading: true
      }
    },
    props: {
      id: {
        type: Number,
        required: true
      }
    },
    methods: {
      remove() {
        this.isLoading = true;
        this.$store.dispatch('Product/deleteProduct', { id: this.id }).then(res => {
          if (!res.hasOwnProperty('errors')){
            this.$emit('getResult', `Товар <strong>${this.name}</strong> успешно удален!`);
            this.$emit('close');
          }
          this.errors = res.errors;
          this.isLoading = false;
        });
      }
    },
    mounted() {
      this.$store.dispatch('Product/updateProduct', { id: this.id }).then(res => {
        this.name = res.name;
        this.isLoading = false;
      });
    }
  }
</script>
