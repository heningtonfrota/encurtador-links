<template>
  <div>
    <Stats class="mt-10" />
    <v-divider class="my-6" />
    <Options />
    <LinkList class="mt-8" />
  </div>
</template>

<script setup>
  import Stats from '@/components/Stats/Index.vue';
  import Options from '@/components/Options/Index.vue';
  import LinkList from '@/components/Link/LinkList.vue';
</script>
