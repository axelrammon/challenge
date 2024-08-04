<script setup>
import { RouterView } from 'vue-router';
import Cabecalho from './components/Cabecalho.vue';
</script>

<template>
  <Cabecalho />

  <div class="main">
    <RouterView />
  </div>

</template>

<style scoped>

  .main {
    background-color: #282828;
    width: 100%;
    height: calc(100vh - 50px);
  }

</style>
