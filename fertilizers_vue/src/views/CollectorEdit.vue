<template>
    <Layout :title="id ? 'Редактирование записи' : 'Создание записи'">
      <CollectorForm :id="id" @submit="onSubmit"/>
    </Layout>
</template>

<script>
import Layout from "@/components/Layout/Layout.vue";
import CollectorForm from "@/components/CollectorForm/CollectorForm.vue";
import {useStore} from "vuex";
import {addItem, updateItem} from "@/store/collector/selectors.js";
export default {
  name: "CollectorEdit",
  props:{ id: String},
  components: {
    Layout,
    CollectorForm,
  },
  setup() {
    const store = useStore()
    return {
      onSubmit:({id,photo,full_name,personal_characteristic,birth_year})=> id ?
          updateItem(store,{id,photo,full_name,personal_characteristic,birth_year}) :
          addItem(store,{photo,full_name,personal_characteristic,birth_year}),
    }
  }
}

</script>
<style scoped>

</style>