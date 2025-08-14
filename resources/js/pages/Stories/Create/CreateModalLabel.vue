<script setup>
defineProps(['htmlFor']);
</script>

<template>
  <label :for="htmlFor" class="text-lg">
    <slot />
  </label>
</template>
