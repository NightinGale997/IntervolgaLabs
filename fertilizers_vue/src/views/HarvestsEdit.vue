<template>
  <Layout :title="id ? 'Редактирование записи' : 'Создание записи'">
    <HarvestsForm :id="id" @submit="onSubmit"/>
  </Layout>
</template>

<script>
import Layout from "@/components/Layout/Layout.vue";
import HarvestsForm from "@/components/HarvestsForm/HarvestsForm.vue";
import {useStore} from "vuex";
import {addItem, updateItem} from "@/store/harvests/selectors.js";

export default {
  name: "HarvestsEdit",
  props:{ id: String},
  components: {
    Layout,
    HarvestsForm,
  },
  setup() {
    const store = useStore()
    return {
      onSubmit:({id,harvest_date,collector_id,quantity,unit_of_measure})=> id ?
          updateItem(store,{id,harvest_date,collector_id,quantity,unit_of_measure}) :
          addItem(store,{harvest_date,collector_id,quantity,unit_of_measure}),
    }
  }
}
</script>


<style scoped>
</style>