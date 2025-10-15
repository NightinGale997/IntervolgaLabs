<template>
  <table v-if="items.length" class="table table-bordered table-hover table-fixed">
    <thead>
    <tr>
      <th v-for="{value, text, width} in headers"
          :key="value"
          class="text-center"
          :style="{ width: width }">
        {{text}}
      </th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(item, index) in items" :key="index">
      <td v-for="(key, index) in colKeys" :key="index" >
        <slot :name="key" v-bind="{item}">
          {{item[key]}}
        </slot>
      </td>
    </tr>
    </tbody>
  </table>
  <div v-else class="text-center p-3">
    Нет данных для отображения.
  </div>
</template>

<script>
export default {
  name: 'Table',
  props: {
    items: Array,
    headers: Array
  },
  computed: {
    colKeys(){
      return this.headers.map(({value}) => value)
    }
  }
}
</script>

<style scoped>
</style>