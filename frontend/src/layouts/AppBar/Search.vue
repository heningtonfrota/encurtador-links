<template>
  <input v-model="search" placeholder="Search or Paste URL" />
</template>

<script setup>
  import { ref, watch } from 'vue';
  import { useSearchStore } from "@/store/search";

  const search_store = useSearchStore();

  const search = ref('');
  let delay_timeout = null;

  watch(search, () => {
    clearTimeout(delay_timeout);
    delay_timeout = setTimeout(() => search_store.setSearch(search.value), 300);
  });
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
