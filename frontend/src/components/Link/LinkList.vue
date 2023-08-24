<template>
  <div>
    <template v-if="links_search.length > 0">
      <ItemLinkList
        v-for="link in links_search"
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
  import { ref } from 'vue';
  import ItemLinkList from '@/components/Link/ItemLinkList.vue';

  const links_search = ref([]);
  const loading_active = ref(false);
</script>
