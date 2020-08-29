<template>
  <div class="form-group">
    <div class="text-muted mb-2"><strong>Изображение:</strong></div>
    <alert v-for="(error, i) in errors" :key="i" v-html="error"/>
    <div class="form-group mb-0">
      <ul class="form-image">
        <li class="form-image__item" v-for="(file, key) in files" :key="key">
          <div class="form-image__remove">
            <unicon name="times" width="18px" fill="red"/>
          </div>
          <img :src="file.tempSrc" alt="" ref="img">
        </li>
        <li class="form-image__upload">
          <label for="file" class="form-image__plus"><span></span></label>
          <input hidden type="file" multiple id="file" @change="changeFile">
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        files: [],
        show: false,
        isLoading: false,
        errors: []
      }
    },
    props: {},
    computed: {},
    methods: {
      /* Валидация входных данных */
      validate(file) {
        const errors = [];
        let type = 0;

        const allowFormat = [
          'image/png',
          'image/jpg',
          'image/jpeg'
        ].findIndex(item => item === file.type);

        file === '' ? errors.push('Поле <strong>Файл для импорта</strong> обязательно для заполнения') :
          allowFormat !== -1 ? '' : errors.push('Допустиый формат файлов: <strong>jpg, png</strong>');

        this.errors = errors.slice();
        return !errors.length;
      },

      /* Событие изменения (загрузки) файла */
      changeFile(e) {
        const files = e.target.files;

        this.files = [...files].map(item => {
          return this.validate(item)
            ? {
              file: item,
              tempSrc: URL.createObjectURL(item)
            }
            : '';
        }).filter(item => item !== '');

        this.$emit('updateFiles', files);
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
