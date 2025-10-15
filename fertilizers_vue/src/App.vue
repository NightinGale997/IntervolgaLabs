<template>
  <div class="d-flex flex-column m-0 pb-5" >
    <div class="d-flex align-items-center">
      <router-view/>
    </div>
    <nav class="navbar navbar-light bg-light fixed-bottom">
      <div class="container-fluid d-flex justify-content-around">
        <router-link to="/harvests" class="btn btn-outline-primary">Сборы урожая</router-link> |
        <router-link to="/collector" class="btn btn-outline-success">Сборщики</router-link></div>
    </nav>
  </div>
</template>

<style>
</style>
<script setup lang="ts">
</script>