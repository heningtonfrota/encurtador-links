<template>
  <v-dialog v-model="dialog_active" content-class="bra-20" width="600">
    <template #activator>
      <slot name="activator" :callback="() => dialog_active = ! dialog_active">
        <v-btn color="#afafaf" icon @click="dialog_active = ! dialog_active">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </slot>
    </template>

    <v-card class="rounded-xl">
      <TitleDialog
        title="New Link"
        :disabled="loading_active"
        @close="close"
      />

      <v-card-text>
        <v-text-field
          v-model="new_link.link"
          label="Link"
          variant="outlined"
          color="primary"
          clearable
          :disabled="loading_active"
          :error-messages="getErrorsMessages('link')"
          @keyup.enter="save"
        />

        <v-text-field
          v-model="new_link.name"
          label="Name"
          variant="outlined"
          color="primary"
          clearable
          class="mt-2"
          :disabled="loading_active"
          :error-messages="getErrorsMessages('name')"
          @keyup.enter="save"
        />

        <v-text-field
          v-model="new_link.slug"
          label="Slug"
          variant="outlined"
          color="primary"
          clearable
          class="mt-2"
          :disabled="loading_active"
          :error-messages="getErrorsMessages('slug')"
          @keyup.enter="save"
        />
      </v-card-text>

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
  import http from '@/plugins/http';
  import { ref, watch } from 'vue';
  import { maxLength, required, url } from '@vuelidate/validators';
  import { useVuelidate } from '@vuelidate/core';
  import { useLinksStore } from "@/store/links";
  import TitleDialog from '@/utils/TitleDialog.vue'

  const dialog_active = ref(false);
  const loading_active = ref(false);
  const linksStore = useLinksStore();
  const props = defineProps(['link_edit']);

  const new_link = ref({
    link: '',
    name: '',
    slug: ''
  });

  watch(dialog_active, () => {
    if (props.link_edit === undefined) return;

    const { link, name, slug } = props.link_edit;

    new_link.value = { link, name, slug }
  })

  const rules = {
    link: {
      required,
      url
    },
    name: {
      maxLength: maxLength(60)
    },
    slug: {
      maxLength: maxLength(60)
    }
  }

  const $v = useVuelidate(rules, new_link)

  function getErrorsMessages(key) {
    if (!$v.value[key].$dirty || $v.value[key].$errors.length === 0) return '';

    const [firstError] = $v.value[key].$errors;

    return String(firstError.$message);
  }

  function create (obj) {
    http.post('links', obj)
      .then(savedSuccessfully)
      .catch(() => alert('Error creating link'))
      .finally(() => close())
  }

  function update(link) {
    http.put(`links/${link.id}`, link)
      .then(savedSuccessfully)
      .catch(() => alert('Error updating link'))
      .finally(() => close())
  }

  function save () {
    $v.value.$touch();

    if ($v.value.$invalid) return;

    loading_active.value = true;

    if (!props.link_edit?.id) {
      create(new_link.value);
      return;
    }

    const params = {
      ...new_link.value,
      id: props.link_edit.id
    }

    update(params);
  }

  function savedSuccessfully() {
    close();

    loading_active.value = false;

    linksStore.executeCallbackUpdateListLinks();
  }

  function close () {
    dialog_active.value = false;

    $v.value.$reset();

    new_link.value = {
      link: '',
      name: '',
      slug: '',
    }
  }
</script>

<style>

</style>
