<template>
  <popup @close="$emit('close')" :width="'1070px'">
    <template v-slot:header>Добавление нового товара</template>
    <template v-slot:body>
      <div class="row">
        <div class="col-md-12">
          <!--          <alert v-show="errors.create.name">Проверьте правильность введенного <strong>логина</strong></alert>-->
          <!--          <alert v-show="errors.create.password">Пароль не может быть короче <strong>8 символов</strong></alert>-->
          <!--          <alert v-show="errors.create.role">Необходимо выбрать хотя бы одну <strong>группу</strong></alert>-->
          <!--          <alert v-show="errors.create.already">Пользователь с логином <strong>{{ result.name }}</strong> уже существует!</alert>-->
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="category" class="text-muted"><strong>Категория:</strong></label>
                <select class="form-control" id="category" v-model="data.role">
                  <option disabled value>Выберите один из вариантов</option>
                  <!--                      <option :value="role.role_id" v-for="role in roles" :key="role.role_id">{{ role.role_name }}</option>-->
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="subcategory" class="text-muted"><strong>Подкатегория:</strong></label>
                <select class="form-control" id="subcategory" v-model="data.role">
                  <option disabled value>Выберите один из вариантов</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group position-relative">
                <label for="meta_keywords" class="text-muted"><strong>Meta Keywords:</strong></label>
                <input id="meta_keywords" class="form-control" v-model="data.name">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group position-relative">
                <label for="meta_description" class="text-muted"><strong>Meta Description:</strong></label>
                <input id="meta_description" class="form-control" v-model="data.name">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group position-relative">
                <label for="meta_title" class="text-muted"><strong>Meta Title:</strong></label>
                <input id="meta_title" class="form-control" v-model="data.name">
              </div>
            </div>
          </div>
          <div class="form-group position-relative">
            <label for="name" class="text-muted"><strong>Название:</strong></label>
            <input id="name" class="form-control" v-model="data.name">
          </div>
          <div class="form-group position-relative">
            <label for="slug" class="text-muted"><strong>URL:</strong></label>
            <input id="slug" class="form-control" v-model="data.name">
          </div>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group position-relative">
                <label for="article" class="text-muted"><strong>Артикул:</strong></label>
                <input id="article" class="form-control" v-model="data.name">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group position-relative">
                <label for="available" class="text-muted"><strong>Наличие:</strong></label>
                <input id="available" class="form-control" v-model="data.name">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group position-relative">
                <label for="price" class="text-muted"><strong>Цена:</strong></label>
                <input id="price" class="form-control" v-model="data.name">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group position-relative">
                <label for="weight" class="text-muted"><strong>Вес:</strong></label>
                <input id="weight" class="form-control" v-model="data.name">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group position-relative">
                <label for="dimension" class="text-muted"><strong>Размеры:</strong></label>
                <input id="dimension" class="form-control" v-model="data.name">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group position-relative">
                <label for="manufacturer" class="text-muted"><strong>Производитель:</strong></label>
                <input id="manufacturer" class="form-control" v-model="data.name">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group position-relative">
                <label for="material" class="text-muted"><strong>Материал:</strong></label>
                <input id="material" class="form-control" v-model="data.name">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group position-relative">
                <label for="technic" class="text-muted"><strong>Техника:</strong></label>
                <input id="technic" class="form-control" v-model="data.name">
              </div>
            </div>
          </div>
          <div class="form-group position-relative">
            <label for="comment" class="text-muted"><strong>Комментарии:</strong></label>
            <input id="comment" class="form-control" v-model="data.name">
          </div>
          <div class="form-group position-relative">
            <label for="description" class="text-muted"><strong>Описание:</strong></label>
            <input id="description" class="form-control" v-model="data.name">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group position-relative">
                <label for="video" class="text-muted"><strong>Видео:</strong></label>
                <input id="video" class="form-control" v-model="data.name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group position-relative">
                <label for="image_path" class="text-muted"><strong>Фото:</strong></label>
                <input id="image_path" class="form-control" v-model="data.name">
              </div>
            </div>
          </div>
          <div class="form-group position-relative">
            <label for="similar_product_id" class="text-muted"><strong>Похожие товары:</strong></label>
            <input id="similar_product_id" class="form-control" v-model="data.name">
          </div>
        </div>
      </div>
    </template>
    <template v-slot:footer>
      <button class="btn btn-primary ml-auto" @click="create">Добавить</button>
    </template>
  </popup>
</template>

<script>
  export default {
    data() {
      return {
        data: {
          name: '',
          password: '',
          role: ''
        }
      }
    },
    computed: {
      roles() {
        return this.$store.getters['User/getRoles'];
      }
    },
    methods: {
      create() {
        const user_login = this.name;
        const user_pass = this.password;
        const role_id = this.role;

        this.$store.dispatch('User/createUser', { user_login, user_pass, role_id })
      },
      /**
       * ПРОВЕРКА ДАННЫХ ПРИ СОЗДАНИИ, ИЗМЕНЕНИИ.
       *
       *  @param data object
       *  @param propName string
       *  @return boolean
       */
      validate(data, propName) {
        let { name, password, role } = data;
        const errors = _.cloneDeep(this.errors);
        const obj = {};

        name === '' ? obj.name = true : obj.name = false;
        password.length < 8 ? obj.password = true : obj.password = false;
        role === '' ? obj.role = true : obj.role = false;

        ( this.$store.getters.getUsers.filter(user => user.id !== this.data.edit.id)
          .some(user => user.name === name) && propName === 'edit' )
          ? obj.already = true
          : obj.already = false;

        propName === 'create' ? errors.create = obj : errors.edit = obj;
        this.errors = errors;

        return !obj.name && !obj.password && !obj.role;
      }
    }
  }
</script>
