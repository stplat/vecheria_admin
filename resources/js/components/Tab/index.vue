<template>
  <div class="tab">
    <div class="tab__links">
      <label class="tab__link" :class="{'is-active': tab.slot === currentTab}" v-for="(tab, key) in tabs" :key="key">
        <input type="radio" :value="tab.slot" :name="tabs[0].slot" v-model="currentTab"
               @click="$emit('update:activeTab', tab.slot)" hidden>
        {{ tab.name }}
      </label>
    </div>
    <div class="tab__body">
      <ul class="tab__screens">
        <li class="tab__screen" :class="{'is-active': tab.slot === currentTab}" v-for="(tab, key) in tabs" :key="key">
          <slot :name="tab.slot"></slot>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        currentTab: ''
      }
    },
    props: {
      tabs: {
        type: Array,
        required: true
      },
      defaultTab: {
        type: String,
        required: false,
      },
    },
    mounted() {
      this.defaultTab ? this.currentTab = this.defaultTab : this.currentTab = this.tabs[0].slot;
      this.$emit('update:activeTab', this.currentTab);
    }
  }
</script>
<style lang="scss" scoped>

</style>
