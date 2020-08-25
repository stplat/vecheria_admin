<template>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group position-relative">
            <label for="weight" class="text-muted"><strong>Вес:</strong></label>
            <input id="weight" class="form-control" v-model="data.weight">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group position-relative">
            <label for="dimension" class="text-muted"><strong>Размеры:</strong></label>
            <input id="dimension" class="form-control" v-model="data.dimension">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group position-relative">
            <label for="video" class="text-muted"><strong>Ссылка на видео:</strong></label>
            <input id="video" class="form-control" v-model="data.video">
          </div>
        </div>
      </div>
      <div class="form-group position-relative">
        <label for="comment" class="text-muted"><strong>Комментарии:</strong></label>
        <textarea id="comment" class="form-control" style="resize: none" v-model="data.comment"></textarea>
      </div>
      <div class="form-group position-relative">
        <label for="description" class="text-muted"><strong>Описание:</strong></label>
        <textarea id="description" class="form-control" style="resize: none" v-model="data.description"></textarea>
      </div>
      <div class="form-group position-relative">
        <label for="similar_product_id" class="text-muted"><strong>Похожие товары:</strong></label>
        <input id="similar_product_id" class="form-control" v-model="data.similar_product_id">
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        data: {
          weight: '',
          dimension: '',
          video: '',
          comment: '',
          description: '',
          similar_product_id: '',
        }
      }
    },

  }
</script>
