<template>
  <div class="form-group">
    <div class="text-muted mb-2"><strong>Изображение:</strong></div>
    <alert :errors.sync="errors" time="3000"/>
    <div class="form-group mb-0">
      <ul class="form-image">
        <li class="form-image__item" v-for="(src, key) in currentFiles" :key="'current' + key">
          <div class="form-image__remove" @click="removeCurrent(src)">
            <unicon name="times" width="18px" fill="red"/>
          </div>
          <img :src="assetBase + src" alt="">
        </li>
        <li class="form-image__item" v-for="item in localStorage" :key="item.id">
          <div class="form-image__remove" @click="remove(item.id)">
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
    computed: {},
    methods: {
      clear(id) {
        console.log(id)
        this.errors = this.errors.filter(item => item.id !== id);
      },
      remove(id) {
        console.log(id)
      },
      /* Валидация входных данных */
      validate(file) {
        const errors = [];
        const allowFormat = [
          'image/png',
          'image/jpg',
          'image/jpeg'
        ].findIndex(item => item === file.type);

        file === ''
          ? this.errors.push({ html: 'Поле <strong>Файл для импорта</strong> обязательно для заполнения', id: this.errors.length, time: 3000 })
          : allowFormat !== -1
          ? '' : errors.push({ html: 'Допустимый формат файлов: <strong>jpg, png</strong>', id: this.errors.length, time: 3000 });

        if (this.localStorage.some(item => item.name === file.name))
          errors.push({ html: `Файл с именем <strong>${ file.name }</strong> уже загружен`, id: this.errors.length, time: 3000 + this.errors.length });

        this.errors = this.errors.concat(errors);
        return !errors.length;
      },

      /* Событие изменения (загрузки) файла */
      changeFile(localFiles) {
        const storage = [...localFiles].map(item => {
          return this.validate(item)
            ? {
              file: item,
              name: item.name,
              tempSrc: URL.createObjectURL(item)
            }
            : '';
        }).filter(item => item !== '');

        this.localStorage = this.localStorage.concat(storage).map((item, key) => {
          item.id = key;
          return item;
        });


        // this.files = [...e.target.files].map(item => {
        //   return this.validate(item)
        //     ? {
        //       file: item,
        //       tempSrc: URL.createObjectURL(item)
        //     }
        //     : '';
        // }).filter(item => item !== '');
        //
        // this.$emit('input', this.files.map(item => item.file));
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
