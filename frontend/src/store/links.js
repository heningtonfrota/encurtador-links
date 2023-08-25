import { defineStore } from 'pinia';
import { computed, ref } from "vue";

export const useLinksStore = defineStore('links', () => {
  const items = ref([]);

  let callbackUpdateListLinks = null;

  const total_clicks = computed(() => {
    return items.value.reduce((a, b) => a + b.clicks, 0)
  })

  function setItems(links) {
    items.value = links
  }

  function setCallback(fn) {
    callbackUpdateListLinks = fn
  }

  function executeCallbackUpdateListLinks() {
    if (!callbackUpdateListLinks) return;
    callbackUpdateListLinks()
  }

  return {
    items,
    setItems,
    setCallback,
    executeCallbackUpdateListLinks,
    total_clicks
  }
})
