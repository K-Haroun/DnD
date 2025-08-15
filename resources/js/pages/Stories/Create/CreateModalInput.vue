<script setup>
import { defineProps } from 'vue';

defineProps({
  type: {
    type: String,
    default: 'text',
  },
  id: {
    type: String,
    required: true,
  },
  name: {
    type: String,
    required: true,
  },
  placehoder: {
    type: String
  }
});

const model = defineModel();

</script>

<template>
  <input
    :type="type"
    :id="id"
    :name="name"
    :placeholder="placehoder"
    v-model="model"
    class="border rounded border-primary/70 bg-primary/10 py-1 px-5 w-100 text-lg"
  />
</template>