<template>
  <Layout title="Сборы урожая">
    <HarvestsList/>
  </Layout>

</template>

<script>


import Layout from "@/components/Layout/Layout.vue";
import HarvestsList from "@/components/HarvestsList/HarvestsList.vue";

export default{
  name: "HarvestsPage",
  components: {Layout, HarvestsList}
}
</script>

<style scoped>

</style>