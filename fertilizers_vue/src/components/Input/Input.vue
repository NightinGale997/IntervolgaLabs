<template>
  <input :id="id" class="form-control " :placeholder="placeholder" >
</template>

<script >
export default {
  name: "Input",
  props: {
    placeholder: String,
    id: String,
  }
}
</script>

<style scoped>

</style>