import { computed } from 'vue';
import { useSearchStore } from '@/store/search';
import { useLinksStore } from '@/store/links';

const links_store = useLinksStore();
const search_store = useSearchStore();

export function useLinksSearch() {
  const linksSearch = computed(() => {
    const search = search_store.search.trim();

    if (search.length === 0) return links_store.items;

    const callback = (item) => JSON.stringify(item).toLowerCase().includes(search.toLowerCase());

    return links_store.items.filter(callback);
  })

  return { linksSearch }
}
