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
  modelValue: {
    type: [String, Number, File],
    required: true,
  },
});

const model = defineModel()

function update() {
  model.value++
}

</script>

<template>
  <input
    :type="type"
    :id="id"
    :name="name"
    class="border px-3 w-1/2 text-md"
    @input="update"
  />
</template>