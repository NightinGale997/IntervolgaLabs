<template>
  <div class="page" :key="route.params.collector_id">
   <HarvestsFilter :items="items" v-model:collector="selectedCollector" />
    <Table
        :headers="[
          {value: 'id', text: 'ID'},
          {value: 'collector_id', text: 'ID сборщика'},
          {value: 'quantity', text: 'Количество'},
          {value: 'unit_of_measure', text: 'Ед. изм.'},
          {value: 'harvest_date', text: 'Дата'},
          {value: 'control', text: 'Управление'},
      ]"
        :items="items"
    >
      <template v-slot:control="{ item }">
        <Btn @click=onClickEdit(item.id) theme="primary" class="me-2">редактировать</Btn>
        <Btn @click=onClickDelete(item.id) theme="danger">Удалить</Btn>
      </template>
    </Table>
    <div class="d-flex justify-content-center">
      <Btn @click="onClickAdd" theme="primary" >Добавить</Btn>
    </div>
  </div>
</template>

<script>

import {useStore} from "vuex";
import {computed, onMounted, ref, watch} from "vue";
import {fetchItems, removeItem, selectItems} from "@/store/harvests/selectors.js";
import router from "@/router/index.js";
import Btn from "@/components/Btn/Btn.vue";
import Table from "@/components/Table/Table.vue";
import {useRoute} from "vue-router";
import HarvestsFilter from "@/components/HarvestsFilter/HarvestsFilter.vue";

export default {
  name: 'HarvestsList',
  components: {HarvestsFilter, Table, Btn},
  setup() {
    const route = useRoute();
    const store = useStore();
    const selectedCollector = ref(route.params.collector_id || '');

    onMounted(()=>{
      fetchItems(store,route.params.collector_id);
    });

    watch(
        ()=> route.params.collector_id,
        (newcollector_id) => {
          selectedCollector.value = newcollector_id || '';
          fetchItems(store, newcollector_id);
        }
    );

    watch(selectedCollector,(newcollector_id)  => {
      router.push({
        name: 'harvests',
        params: {collector_id: newcollector_id || undefined}
      });
    });

    const onClickEdit = (id) =>{
      router.push(`/harvests-edit/${id}`);
    }

    const onClickDelete = (id) =>{
      const isConfirmRemove = confirm('Вы действительно хотите удалить запись?')
      if(isConfirmRemove){
        removeItem(store,id);
      }
    }

    const onClickAdd = () =>{
      router.push(`/harvests-edit/`);
    }

    return {
      route,
      selectedCollector,
      items: computed(()=> selectItems(store)),
      onClickEdit,
      onClickDelete,
      onClickAdd
    }
  }
}
</script>

<style scoped>

</style>