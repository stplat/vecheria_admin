<template>
  <div class="form-group">
    <div class="text-muted mb-2"><strong>Изображение:</strong></div>
    <alert v-for="(error, i) in errors" :key="i" v-html="error"/>
    <div class="form-group mb-0">
      <ul class="form-image">
        <li class="form-image__item" v-for="(src, key) in currentFiles" :key="'current' + key">
          <div class="form-image__remove" @click="removeCurrentFiles(key)">
            <unicon name="times" width="18px" fill="red"/>
          </div>
          <img :src="assetBase + src" alt="">
        </li>
        <li class="form-image__item" v-for="item in localStorage" :key="item.id">
          <div class="form-image__remove" @click="removeStorage(item.id)">
            <unicon name="times" width="18px" fill="red"/>
          </div>
          <img :src="item.tempSrc" alt="">
        </li>
        <li class="form-image__upload">
          <label for="file" class="form-image__plus"><span></span></label>
          <input id="file" type="file" multiple hidden @change="changeFile($event.target.files)">
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        localStorage: [],
        errors: []
      }
    },
    props: {
      value: {
        type: [Array, FileList]
      },
      currentFiles: {
        type: Array,
        required: false
      }
    },
    watch: {
      localStorage() {
        this.$emit('input', this.localStorage.map(item => item.file).concat(this.currentFiles));
      },
      currentFiles() {
        this.$emit('input', this.localStorage.map(item => item.file).concat(this.currentFiles));
      }
    },
    computed: {},
    methods: {
      removeStorage(id) {
        this.localStorage = this.localStorage.filter(item => item.id !== id);
      },
      removeCurrentFiles(key) {
        this.$emit('removePhoto', key);
      },
      /* Валидация входных данных */
      validate(file) {
        const errors = [];
        const allowFormat = [
          'image/png',
          'image/jpg',
          'image/jpeg'
        ].findIndex(item => item === file.type);

        file === '' ? errors.push('Поле <strong>Файл для импорта</strong> обязательно для заполнения') :
          allowFormat !== -1 ? '' : errors.push('Допустиый формат файлов: <strong>jpg, png</strong>');

        if (this.localStorage.some(item => item.name === file.name))
          errors.push(`Файл с именем <strong>${ file.name }</strong> уже загружен`);

        this.errors = this.errors.concat(errors);
        return !errors.length;
      },

      /* Событие изменения (загрузки) файла */
      changeFile(localFiles) {
        this.errors = [];
        const storage = [...localFiles].map(item => {
          return this.validate(item)
            ? {
              file: item,
              name: item.name,
              tempSrc: URL.createObjectURL(item)
            }
            : '';
        }).filter(item => item !== '' && item !== undefined);

        this.localStorage = this.localStorage.concat(storage).map((item, key) => {
          item.id = key;
          return item;
        });
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
