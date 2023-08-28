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

  function setOrder(param) {
    switch (param) {
      case "1":
        items.value.sort((a,b) => a.link.localeCompare(b.link));
        break;
      case "2":
        items.value.sort((a,b) => a.slug.localeCompare(b.slug));
        break;
      case "3":
        items.value.sort((a,b) => a.name.localeCompare(b.name));
        break;
      case "4":
        items.value.sort((a,b) => a.id - b.id);
        break;
      case "5":
        items.value.sort((a,b) => a.clicks - b.clicks);
        break;

      default:
        break;
    }
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
    setOrder,
    setItems,
    setCallback,
    executeCallbackUpdateListLinks,
    total_clicks
  }
})
