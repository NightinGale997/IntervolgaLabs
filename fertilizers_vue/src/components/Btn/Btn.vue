<template>
  <button :disabled="disabled" :class="['btn',themeClass]">
    <slot/>
  </button>
</template>

<script>
export default {
  name: 'Btn',
  props: {
    theme: String,
    disabled: Boolean,
  },
  computed: {
    themeClass() {
      return `btn-${this.theme}`;
    }
  }
}
</script>
<style scoped>

</style>