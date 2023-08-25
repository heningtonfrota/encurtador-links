import { defineStore } from 'pinia';
import { ref } from "vue";

export const useSearchStore = defineStore('search', () => {
  const search = ref('');

  function setSearch(text) {
    search.value = text;
  }

  return {
    search,
    setSearch
  }
})
