<template>
  <v-app-bar flat color="white" :height="80">
    <div class="d-flex align-center justify-space-between w-100 px-6">
      <div>
        <span class="text-blue-grey-lighten-1 font-weight-bold">DDSV</span>
      </div>

      <div class="w-50 d-flex align-center justify-space-between">
        <v-icon color="#afafaf" class="mr-3">mdi-magnify</v-icon>

        <Search class="mx-1" />

        <New />
      </div>

      <div>
        <v-badge dot color="red" :offset-y="10" :offset-x="10">
          <v-btn color="#afafaf" icon>
            <v-icon>mdi-bell-outline</v-icon>
          </v-btn>
        </v-badge>
      </div>
    </div>
  </v-app-bar>
</template>

<script setup>
  import Search from './Search.vue';
  import New from '@/components/Link/New.vue';
</script>
