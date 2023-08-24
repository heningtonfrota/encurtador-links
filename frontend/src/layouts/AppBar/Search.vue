<template>
  <input v-model="search" placeholder="Search or Paste URL" />
</template>

<script setup>
  import { ref } from 'vue';
  const search = ref('');
</script>

<style scoped>
  input {
    width: 100%;
    background: #f3f2f2;
    padding: 10px 10px;
    border-radius: 4px;
    text-align: center;
    font-size: .9rem;
    outline: none;
  }
  input:focus {
    border: .14rem solid #64B5F6;
  }
</style>
