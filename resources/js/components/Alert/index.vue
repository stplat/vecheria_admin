<template>
  <!--  <transition name="alert-list" mode="out-in">-->
  <!--    <div class="alert" v-if="show" :class="'alert-' + className" role="alert">-->
  <!--      <slot></slot>-->
  <!--    </div>-->
  <!--  </transition>-->
  <transition-group tag="ul" name="alert-list" mode="out-in">
    <li class="alert" v-for="error in errors"
        :key="error.id"
        :class="error.hasOwnProperty('className') ? 'alert-' + error.className : 'alert-danger'"
        v-html="error.html">
    </li>
  </transition-group>
</template>

<script>
  export default {
    data() {
      return {
        timer: 0
      }
    },
    props: {
      errors: {
        type: Array,
        required: true
      },
      time: {
        type: [Number, String],
        required: false
      }
    },
    watch: {
      errors() {
        if (this.time) {
          this.timer = setTimeout(() => console.log('asd'), this.time)
        }
      }
    }
  }
</script>

<style lang="scss" scoped>
  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
  }

  .list-enter-active, .list-leave-active,
  .alert-list-enter-active, .alert-list-leave-active {
    transition: all 0.1s;
  }

  .list-enter, .list-leave-to {
    opacity: 0;
    transform: translateY(30px);
  }

  .alert-list-enter, .alert-list-leave-to {
    opacity: 0;
    transform: translateY(-30px);
  }

  .alert {
    line-height: 1.3rem !important;
  }
</style>
