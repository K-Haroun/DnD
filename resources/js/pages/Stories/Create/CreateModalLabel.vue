<script setup>
defineProps(['htmlFor']);
</script>

<template>
  <label :for="htmlFor" class="text-md">
    <slot />
  </label>
</template>
