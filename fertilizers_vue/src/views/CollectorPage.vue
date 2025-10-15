<template>
  <Layout title="Сборщики">
    <CollectorList/>
  </Layout>
</template>

<script>
import Layout from "@/components/Layout/Layout.vue";
import CollectorList from "@/components/CollectorList/CollectorList.vue";
import CollectorFilter from "@/components/CollectorFilter/CollectorFilter.vue";

export default{
  name: "CollectorsPage",
  components: {CollectorFilter: CollectorFilter, Layout, CollectorList}
}
</script>

<style scoped>

</style>