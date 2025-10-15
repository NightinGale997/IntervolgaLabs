<template>
  <select v-model="internalCollector" @change="handleChange" >
    <option value="">Все</option>
    <option v-for="item in filteredItems" :key="item.collector_id" :value="item.collector_id" >{{ item.collector_id }}</option>
  </select>
  <div v-if="internalCollector" class="filter-message">
    Фильтр: {{ items[0].collector_id }}
  </div>
</template>

<script>

import {computed, ref, watch} from "vue";

export default {
  props: ['items', 'collector'],
  setup(props, { emit }) {
    const internalCollector = ref(props.collector);

    const filteredItems = computed(() => {
      const seen = new Set();
      return props.items.filter(item => {
        const id = item.collector_id;
        if (!seen.has(id)) {
          seen.add(id);
          return true;
        }
        return false;
      });
    });

    watch(() => props.collector, (newVal) => {
      internalCollector.value = newVal;
    });

    const handleChange = () => {
      emit('update:collector', internalCollector.value);
    };

    return { internalCollector, handleChange,filteredItems};
  }
}
</script>
