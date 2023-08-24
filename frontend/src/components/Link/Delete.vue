<template>
  <v-dialog v-model="dialog_active" :width="350">
    <template #activator>
      <v-btn
        icon
        variant="text"
        color="grey-darken-1"
        class="ml-n3"
        @click="dialog_active = ! dialog_active"
      >
        <v-icon :size="20">mdi-trash-can-outline</v-icon>
      </v-btn>
    </template>

    <v-card class="rounded-xl">
      <TitleDialog
        title="Delete"
        icon="mdi-delete"
        :disabled="loading_active"
        @close="dialog_active = ! dialog_active"
      />

      <v-card-text class="pt-0">
        <span class="text-caption">
          {{ props.id ? 'Do you really want to delete this link?' : 'Do you really want to delete all links?' }}
        </span>
      </v-card-text>

      <v-card-actions class="justify-end px-4 mt-n4">
        <v-btn
          class="text-none"
          variant="text"
          color="red"
          :loading="loading_active"
          @click="deleteLink"
        >
          YES
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
  import http from '@/plugins/http';
  import { ref } from "vue";
  import TitleDialog from "@/utils/TitleDialog.vue";

  const props = defineProps({ id: String })

  const dialog_active = ref(false)
  const loading_active = ref(false)

  function deleteLink() {
    loading_active.value = true;

    http.delete(`links/${props.id || ''}`)
      .catch(() => alert('error deleting link'))
      .finally(() => close());
  }

  function close() {
    dialog_active.value = false;
    loading_active.value = false;
  }
</script>
