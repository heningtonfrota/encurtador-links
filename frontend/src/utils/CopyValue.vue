<template>
  <slot :copy="copy" />
</template>

<script setup>
  const props = defineProps({ value: String });

  function copy() {
    navigator.clipboard.writeText(props.value + '').catch(() => alert('Text cannot be copied.'));
  }
</script>
