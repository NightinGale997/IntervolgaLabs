<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow">
          <div class="card-body">

            <div v-if="form.id" class="mb-3">
              <label for="id" class="form-label">ID</label>
              <input :value="form.id" id="id" placeholder="id" class="form-control" disabled readonly/>
            </div>

            <div class="mb-3">
              <label for="photo" class="form-label">Фото</label>

              <div v-if="previewImage" class="input-group mb-2">
                <img :src="previewImage" alt="Preview" class="img-fluid product-image">
              </div>
              <div v-else-if="typeof form.photo === 'string' && form.photo">
                <img :src="`/fertilizers/templates/images/${form.photo}`" alt="Фото" class="img-fluid product-image">
              </div>

              <input type="file" class="form-control" @change="handleFileUpload">
            </div>

            <div class="mb-3">
              <label for="full_name" class="form-label">ФИО</label>
              <input v-model="form.full_name" id="full_name" placeholder="ФИО" class="form-control"/>
            </div>

            <div class="mb-3">
              <label for="personal_characteristic" class="form-label">Описание</label>
              <input v-model="form.personal_characteristic" id="personal_characteristic" placeholder="Описание" class="form-control"/>
            </div>

            <div class="mb-3">
              <label for="birth_year" class="form-label">Год рождения</label>
              <input v-model="form.birth_year" id="birth_year" placeholder="Год рождения" class="form-control" type="number" />
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
import {computed, onBeforeMount, reactive, ref, watchEffect} from "vue";
import {fetchItems, selectItemsById} from "@/store/collector/selectors.js";
import router from "@/router/index.js";
import Btn from "@/components/Btn/Btn.vue";

export default {
  components: { Btn },
  props: {
    id: { type: String, default: '' },
  },
  setup(props, { emit }) {
    const store = useStore();

    const form = reactive({
      id: '',
      photo: '',
      full_name: '',
      personal_characteristic: '',
      birth_year: ''
    });
    const previewImage = ref(null);
    onBeforeMount(() => {
      fetchItems(store);
    });

    watchEffect(() => {
      const collector = selectItemsById(store, props.id);
      Object.keys(collector).forEach(key => {
        console.log(key);
        form[key] = collector[key];
      });
    });

    const handleFileUpload = (event) => {
      const file = event.target.files[0];
      if (file) {
        form.photo = file;
        previewImage.value = URL.createObjectURL(file);
      } else {
        form.photo = '';
        previewImage.value = null;
      }
    };


    const isValidForm = computed(() => {
      return Boolean(form.full_name && form.personal_characteristic && form.birth_year && (form.photo));
    });

    const onClick = () => {
      emit("submit", form);
      router.push("/collector");
    };

    return {
      form,
      previewImage,
      handleFileUpload,
      isValidForm,
      onClick
    };
  }
};
</script>

<style scoped>
.product-image {
  max-height: 200px;
}
</style>
