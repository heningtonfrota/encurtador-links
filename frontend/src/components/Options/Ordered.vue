<template>
  <v-dialog v-model="dialog_active" content-class="bra-20" width="600">
    <template #activator>
      <v-btn
        icon="mdi-swap-horizontal"
        color="grey-darken-1"
        variant="text"
        class="mr-3 rotate-90deg"
        @click="dialog_active = true"
      />
    </template>

    <v-card class="rounded-xl">
      <TitleDialog
        title="Ordered"
        :disabled="loading_active"
        @close="close"
      />

      <v-radio-group label="Order by ascendent" v-model="radio">
        <v-radio label="Link" value="1"></v-radio>
        <v-radio label="Slug" value="2"></v-radio>
        <v-radio label="Name" value="3"></v-radio>
        <v-radio label="Created" value="4"></v-radio>
        <v-radio label="Clicks" value="5"></v-radio>
      </v-radio-group>

      <v-card-actions class="justify-end px-4 mt-n4">
        <v-btn
          class="text-none"
          variant="text"
          color="primary"
          :loading="loading_active"
          @click="save"
        >
          Salvar
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
  import { ref, watch } from 'vue';
  import { useLinksStore } from "@/store/links";
  import TitleDialog from '@/utils/TitleDialog.vue';

  const links_store = useLinksStore();
  const radio = ref();
  const dialog_active = ref(false);
  const loading_active = ref(false);

  watch(radio, (value) => {
    links_store.setOrder(value);
    close();
  });

  function close () {
    dialog_active.value = false;
  }
</script>

<style>

</style>
