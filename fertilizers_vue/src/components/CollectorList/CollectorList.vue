<template>
  <div class="page p-3" :key="route.params.full_name">
    <CollectorFilter :items="items" v-model:full_name="selectedFullName" />

    <div class="table-responsive mt-3">
      <Table
          :headers="[
            {value: 'id', text: 'ID', width: '5%'},
            {value: 'photo', text: 'Фото', width: '15%'},
            {value: 'full_name', text: 'ФИО', width: '20%'},
            {value: 'personal_characteristic', text: 'Описание', width: '25%'},
            {value: 'birth_year', text: 'Год рождения', width: '10%'},
            {value: 'control', text: 'Управление', width: '25%'},
        ]"
          :items="items"
      >
        <template v-slot:photo="{ item }">
          <img v-if="typeof item.photo === 'string'" :src="`${getImageUrl(item.photo)}`" alt="Фото" class="product-image img-fluid">
        </template>
        <template v-slot:control="{ item }">
          <div class="d-flex flex-wrap justify-content-center">
            <Btn @click="onClickEdit(item.id)" theme="primary" class="me-2 mb-1">редактировать</Btn>
            <Btn @click="onClickDelete(item.id)" theme="danger" class="mb-1">Удалить</Btn>
          </div>
        </template>
      </Table>
    </div>

    <div class="d-flex justify-content-center mt-3"> <Btn @click="onClickAdd" theme="primary">Добавить</Btn>
    </div>
  </div>
</template>

<script>
import Table from "@/components/Table/Table.vue";
import Btn from "@/components/Btn/Btn.vue";
import {useStore} from "vuex";
import {computed, onMounted, ref, watch} from "vue";
import {fetchItems, removeItem, selectItems} from "@/store/collector/selectors.js";
import router from "@/router/index.js";
import CollectorFilter from "@/components/CollectorFilter/CollectorFilter.vue";
import {useRoute} from "vue-router";

export default {
  name: 'CollectorList',
  components: {CollectorFilter, Table, Btn,Filter: CollectorFilter },
  setup() {
    const route = useRoute();
    const store = useStore();
    const selectedFullName = ref(route.params.full_name || '');
    onMounted(()=>{
      fetchItems(store,route.params.full_name);
    });

    watch(
        ()=> route.params.full_name,
        (newFullNameId) => {
          selectedFullName.value = newFullNameId || '';
          fetchItems(store,newFullNameId);
        }
    );

    const getImageUrl = (filename) => {
      return `/fertilizers/templates/images/${filename}`;
    };

    watch(selectedFullName,(newFullNameId)  => {
      router.push({
        name: 'collector',
        params: {full_name: newFullNameId || undefined}
      });
    });
    const onClickEdit = (id) =>{
      router.push(`/collector-edit/${id}`);
    }

    const onClickDelete = (id) =>{
      const isConfirmRemove = confirm('Вы действительно хотите удалить запись?')
      if(isConfirmRemove){
        removeItem(store,id);
      }
    }

    const onClickAdd = () =>{
      router.push(`/collector-edit/`);
    }

    return {
      route,
      getImageUrl,
      items: computed(()=> selectItems(store)),
      selectedFullName,
      onClickEdit,
      onClickDelete,
      onClickAdd
    }
  },
}
</script>

<style scoped>
.product-image {
  max-width: 80px;
  max-height: 80px;
  height: auto;
  display: block;
  margin: 0 auto;
}
</style>