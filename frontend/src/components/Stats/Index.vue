<template>
  <div>
    <div class="d-flex align-center">
      <span class="text-body-2 font-weight-medium text-grey-darken-2">STATS</span>
      {{ linksSearch.value }}
      <v-spacer />

      <span class="text-body-2 font-weight-medium text-grey-lighten-1">See all</span>
    </div>

    <div class="d-flex align-center justify-space-between">
      <Stat
        v-for="(stat, key) in stats"
        :key="key"
        :stat="stat"
      />
    </div>
  </div>
</template>

<script setup>
  import {computed} from "vue";
  import Stat from './Stat.vue';
  import { useLinksSearch } from "@/layouts/AppBar/search.js";
  import { useLinksStore } from '@/store/links';

  const links_store = useLinksStore();
  const { linksSearch } = useLinksSearch();


  const stats = computed(() => ([
  {
    icon: 'mdi-link-variant',
    value: linksSearch.value.length,
    text: 'Links'
  },
  {
    icon: 'mdi-eye-outline',
    value: 0,
    text: 'Views'
  },
  {
    icon: 'mdi-cursor-default-click-outline',
    value: links_store.total_clicks,
    text: 'Clicks'
  },
  {
    icon: 'mdi-chart-line-variant',
    value: 0,
    text: 'Avg. CTR',
    sufix: '%'
  },
  {
    icon: 'mdi-clock-outline',
    value: 0,
    text: 'Avg Time',
    sufix: 's'
  }
]))
</script>
