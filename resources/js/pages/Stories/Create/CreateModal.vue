<script setup>
import CreateModalField from "./CreateModalField.vue";
import CreateModalInput from "./CreateModalInput.vue";
import CreateModalLabel from "./CreateModalLabel.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from 'vue';

const form = useForm({
  title: "",
  plot: "",
  map: null,
});

const emit = defineEmits(['close']);

const submit = () => {
  form.post(route("stories.store"), {
    onSuccess: () => {
      emit('close');
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
    <div class="bg-primary p-6 rounded shadow-lg w-[500px]">
      <div class="flex justify-between items-center mb-5">
        <h2 class="text-xl font-bold">Create New Story</h2>
        <button @click="$emit('close')">&#10006;</button>
      </div>
      <form @submit.prevent="submit">
        <div class="flex flex-col gap-3 mb-5">
          <CreateModalField>
            <CreateModalLabel htmlFor="title">Title</CreateModalLabel>
            <CreateModalInput v-model="form.title" type="text" id="title" name="title" />
          </CreateModalField>

          <CreateModalField>
            <CreateModalLabel htmlFor="plot">Plot</CreateModalLabel>
            <CreateModalInput v-model="form.plot" type="text" id="plot" name="plot" />
          </CreateModalField>

          <CreateModalField>
            <CreateModalLabel htmlFor="map">Map</CreateModalLabel>
            <CreateModalInput
              type="file"
              id="map"
              name="map"
              accept=".pdf,.jpg,.png"
              @input="handleFileChange"
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

          <button type="submit" :disabled="form.processing">Create Story</button>
        </div>
      </form>
    </div>
  </div>
</template>