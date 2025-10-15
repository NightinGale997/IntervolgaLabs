<template>
  <div class="d-flex flex-column justify-content-center w-100 p-3">
    <h1 v-if="title" class="text-center mb-4">{{title}}</h1>
    <div class="flex-grow-1 d-flex justify-content-center">
      <slot/>
    </div>
  </div>


</template>

<script>
export default {
  name: "Layout",
  props: {
    title: {type: String}
  }
}
</script>

<style scoped>

</style>