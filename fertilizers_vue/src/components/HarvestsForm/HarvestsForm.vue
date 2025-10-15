<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <div v-if="form.id" class="mb-3">
              <label for="id" class="form-label">ID</label>
              <input :value="form.id" id="id" placeholder="id" class="form-control" disabled readonly/>
            </div>

            <div class="mb-3">
              <label for="collector_id" class="form-label">Сборщик</label>
              <select v-model="form.collector_id" id="collector_id" name="collector_id" class="form-select">
                <option value="" disabled selected>Выберите сборщика</option>
                <option v-for="collector in collectorList" :key="collector.id" :value="collector.id">
                  {{ collector.id }} {{ collector.full_name }}
                </option>
              </select>
            </div>

            <div class="mb-3">
              <label for="quantity" class="form-label">Количество</label>
              <input v-model="form.quantity" id="quantity" placeholder="Количество" class="form-control" type="number" required>
            </div>

            <div class="mb-3">
              <label for="unit_of_measure" class="form-label">Единица измерения</label>
              <input v-model="form.unit_of_measure" id="unit_of_measure" placeholder="Единица измерения" class="form-control" required>
            </div>

            <div class="mb-3">
              <div>
                <label for="harvest_date" class="form-label">Дата сбора</label>
                <input v-model="form.harvest_date" id="harvest_date" placeholder="Дата сбора" class="form-control" type="date" required />
              </div>
            </div>

            <div class="d-grid gap-2">
              <Btn @click="onClick" :disabled="!isValidForm" theme="primary">Сохранить</Btn>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</template>

<script>

import {useStore} from "vuex";
import {computed, onBeforeMount, reactive, watchEffect} from "vue";
import {fetchItems} from "@/store/harvests/selectors.js";
import {selectItemsById} from "@/store/harvests/selectors.js";
import {selectItems as selectGroups,fetchItems as fetchGroups} from "@/store/collector/selectors.js";
import router from "@/router/index.js";
import Btn from "@/components/Btn/Btn.vue";

export default {
  components: {Btn},
  props: {
    id: {type: String, default: ''},
  },

  setup(props, context) {
    const store = useStore();
    const collectorList = computed(() => selectGroups(store))
    const form = reactive({
      id: '',
      harvest_date: '',
      collector_id: null,
      quantity: '',
      unit_of_measure: ''
    });

    onBeforeMount(() => {
      fetchItems(store);
      fetchGroups(store);
    });

    watchEffect(() => {
      const harvests = selectItemsById(store, props.id);
      Object.keys(harvests).forEach((key) => {
        form[key] = harvests[key];
      })
    })

    return {
      form,
      collectorList,
      isValidForm: computed(() => !!(form.harvest_date && form.collector_id !== null && form.quantity && form.unit_of_measure)),
      onClick: () => {
        context.emit("submit", form);
        router.push("/harvests");
      }
    };
  }
}
</script>


<style scoped>
</style>