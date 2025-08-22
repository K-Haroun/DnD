<script setup>
defineProps(['htmlFor']);
</script>

<template>
  <label :for="htmlFor" class="text-sm">
    <slot />
  </label>
</template>
