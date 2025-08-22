<script setup>
import { defineProps } from "vue";

defineProps({
  type: {
    type: String,
    default: "text",
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
    type: String,
  },
});

const model = defineModel();
</script>

<template>
  <textarea
    :type="type"
    :id="id"
    :name="name"
    :placeholder="placehoder"
    v-model="model"
    rows="10"
    cols="40"
    class="block h-30 border rounded border-primary/70 bg-primary/10 placeholder-gray-300/20 focus:ring-primary py-1 px-5 text-lg resize-none" />
</template>

