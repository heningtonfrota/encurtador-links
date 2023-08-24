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
  import { ref } from 'vue';
  import { maxLength, required, url } from '@vuelidate/validators';
  import { useVuelidate } from '@vuelidate/core';
  import TitleDialog from '@/utils/TitleDialog.vue'

  const dialog_active = ref(false);
  const loading_active = ref(false);

  const new_link = ref({
    link: '',
    name: '',
    slug: ''
  });

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
      .catch(() => {
        alert('error creating link')
        close()
      })
  }

  function save () {
    $v.value.$touch();

    if ($v.value.$invalid) return;

    loading_active.value = true;

    create(new_link.value);
  }

  function savedSuccessfully() {
    close();
    loading_active.value = false;
    // linksStore.executeCallbackUpdateListLinks()
  }

  function close () {
    dialog_active.value = !dialog_active.value;
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
