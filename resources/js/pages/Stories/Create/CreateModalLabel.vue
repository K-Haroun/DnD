<script setup>
defineProps(['for']);
</script>

<template>
  <label :for="for" class="text-2xl">
    <slot />
  </label>
</template>
