<template>
  <div>
    <template v-if="linksSearch.length > 0">
      <ItemLinkList
        v-for="link in linksSearch"
        :key="link.id"
        :link="link"
        class="mb-4"
      />
    </template>

    <div v-else-if="loading_active" class="text-center mt-10">
      <v-progress-linear color="primary" :size="45" />
      <p class="text-caption text-grey-darken-1 mt-2">Loading... please wait</p>
    </div>

    <span v-else class="text-grey-lighten-1 text-subtitle-1">No link found</span>
  </div>
</template>

<script setup>
  import http from '@/plugins/http';
  import { ref, onMounted } from 'vue';
  import ItemLinkList from '@/components/Link/ItemLinkList.vue';
  import { useLinksStore } from '@/store/links';
  import { useLinksSearch } from '@/layouts/AppBar/search.js';

  const loading_active = ref(false);

  const { linksSearch } = useLinksSearch();
  const links_store = useLinksStore();

  onMounted(getLinksApi)
  links_store.setCallback(getLinksApi)

  function getLinksApi() {
    http.get('links')
      .then(response => {
        links_store.setItems(response.data.links);
        loading_active.value = false;
      })
      .catch(() => alert('Error when fetching links'))
  }
</script>
