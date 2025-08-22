<script setup>
import { ref, defineProps } from "vue";
import { Upload } from "lucide-vue-next";

const props = defineProps({
  id: {
    type: String,
    required: true,
  },
  name: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    default: "Choose File",
  },
  accept: {
    type: String,
    default: ".pdf,.jpg,.png",
  },
});

const model = defineModel();

const fileName = ref("");

function handleFileChange(event) {
  const file = event.target.files?.[0];
  if (file) {
    fileName.value = file.name;
    model.value = file;
  } else {
    fileName.value = "";
    model.value = null;
  }
}
</script>

<template>
  <div>
    <input
      :id="id"
      :name="name"
      :accept="accept"
      type="file"
      class="hidden"
      @change="handleFileChange"
    />

    <label
      :for="id"
      class="border rounded border-dashed border-primary/70 bg-primary/10 hover:bg-primary/50 transition-colors duration-300 text-sm flex flex-col justify-center items-center gap-1 w-100 h-30 cursor-pointer"
    >
      <Upload class="size-5"/>
      <span class="px-3">{{ label }}</span>
      <span v-if="fileName" class="text-xs">{{ fileName }}</span>
      <span v-else class="text-xs">No file chosen</span>
    </label>
  </div>
</template>
