<template>
  <div class="card">
    <h4 class="card-header">Загрузка фотографий</h4>
    <div class="card-body">
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
  </div>
</template>
<script>
  import axios from 'axios';

  export default {
    data() {
      return {
        data: {
          upload: {
            name: '',
            file: ''
          }
        },
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
          allowFormat !== -1 ? '' : errors.push('Допустиый формат файлов <strong>csv</strong>');

        this.data.upload.type = type;
        this.errors = errors.slice();
        return !errors.length;
      },

      /* Событие изменения (загрузки) файла */
      changeFile(e) {
        const files = e.target.files;

        this.files = [...files].map(item => {
          return {
            file: item,
            tempSrc: URL.createObjectURL(item)
          }
        });

        const formData = new FormData();
        // formData.append('file', files);
        for (let param in files) {
          if (files.hasOwnProperty(param)) {
            formData.append('file['+ param +']', files[param]);
          }
        }
        axios.post('/admin/products', formData).then(res => console.log(res));

      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
