<template>
  <select v-model="internalName" @change="handleChange" >
    <option value="">Все</option>
    <option v-for="item in filteredItems" :key="item.full_name" :value="item.full_name" >{{ item.full_name }}</option>
  </select>
  <div v-if="internalName" class="filter-message">
    Фильтр: {{ items[0].full_name }}
  </div>
</template>

<script>

import {computed, onBeforeUnmount, ref, watch} from "vue";

export default {
  props: ['items', 'full_name'],
  setup(props, { emit }) {
    const internalName = ref(props.full_name);

    watch(() => props.full_name, (newVal) => {
      internalName.value = newVal;
    });

    const filteredItems = computed(() => {
      const seen = new Set();
      return props.items.filter(item => {
        const name = item.full_name;
        if (!seen.has(name)) {
          seen.add(name);
          return true;
        }
        return false;
      });
    });

    const handleChange = () => {
        emit('update:full_name', internalName.value);
    };

    return { internalName, handleChange, filteredItems};
  }
}
</script>
