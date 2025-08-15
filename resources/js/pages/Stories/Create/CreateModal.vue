<script setup>
import CreateModalField from "./CreateModalField.vue";
import CreateModalInput from "./CreateModalInput.vue";
import CreateModalInputFile from "./CreateModalInputFile.vue";
import CreateModalLabel from "./CreateModalLabel.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
  title: "",
  plot: "",
  map: null,
});

const emit = defineEmits(["close"]);

const submit = () => {
  form.post(route("stories.store"), {
    onSuccess: () => {
      emit("close");
    },
  });
};

const handleFileChange = (event) => {
  const target = event.target;
  if (target.files) {
    form.map = target.files[0];
  }
};
</script>

<template>
  <div
    class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
  >
    <div class="bg-secondary p-6 rounded shadow-lg">
      <div class="flex justify-between items-center mb-5 pb-3 border-b border-primary/70">
        <h2 class="text-xl font-bold">Create New Story</h2>
        <button @click="$emit('close')" class="cursor-pointer">&#10006;</button>
      </div>
      <form @submit.prevent="submit">
        <div class="flex flex-col justify-center items-start gap-3">
          <CreateModalField>
            <CreateModalLabel htmlFor="title">Title</CreateModalLabel>
            <CreateModalInput
              v-model="form.title"
              type="text"
              id="title"
              name="title"
              placeholder="Brad And The Seven Elves"
            />
          </CreateModalField>

          <CreateModalField>
            <CreateModalLabel htmlFor="plot">Plot</CreateModalLabel>
            <CreateModalInput
              v-model="form.plot"
              type="text"
              id="plot"
              name="plot"
              placeholder="Once upon a time..."
              class="pb-50 pt-3"
            />
          </CreateModalField>

          <CreateModalField>
            <CreateModalLabel htmlFor="map">Map</CreateModalLabel>
            <CreateModalInputFile
              v-model="form.map"
              id="map"
              name="map"
              label="Click to upload"
              accept=".pdf,.jpg,.png"
            />
            <span v-if="form.errors.map" class="text-red-500">{{ form.errors.map }}</span>
          </CreateModalField>

          <div v-if="form.errors.title">
            <p class="text-red-500 text-sm">
              {{ form.errors.title }}
            </p>
          </div>
          <div v-if="form.errors.plot">
            <p class="text-red-500 text-sm">
              {{ form.errors.plot }}
            </p>
          </div>

          <div class="w-100 flex justify-between mt-3">
            <button type="button" @click="$emit('close')" class="border rounded border-primary/70 bg-primary/60 hover:bg-primary transition-colors duration-300 cursor-pointer text-sm py-2 px-4">
              Cancel
            </button>
            <button type="submit" :disabled="form.processing" class="border rounded border-primary/70 bg-primary/60 hover:bg-primary transition-colors duration-300 cursor-pointer text-sm py-2 px-4">
              Create Story
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
