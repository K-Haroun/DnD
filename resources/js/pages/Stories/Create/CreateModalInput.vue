<script setup>
defineProps<Props>(['type', 'id', 'name']);
</script>

<template>
  <input :type="type" :id="id" :name="name" class="border px-3 w-1/2 text-md" />
</template>
