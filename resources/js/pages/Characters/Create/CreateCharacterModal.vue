<script setup>
import { useForm } from "@inertiajs/vue3";
import CreateModalField from "@/components/modals/CreateModalField.vue";
import CreateModalLabel from "@/components/modals/CreateModalLabel.vue";
import CreateModalInput from "@/components/modals/CreateModalInput.vue";
import CreateModalTextArea from "@/components/modals/CreateModalTextArea.vue";
import CreateModalInputNumber from "@/components/modals/CreateModalInputNumber.vue";
import { ref } from "vue";

const props = defineProps(['story']);
const emit = defineEmits(['close']);

const form = useForm({
  name: "",
  race: "",
  class: "",
  alignment: "",
  level: 1,
  current_hp: 1,
  max_hp: 1,
  armor_class: 1,
  initiative: 1,
  speed: 1,
  strength: 1,
  backstory: "",
  story_id: props.story.id,
});

const submit = () => {
  form.post(route("characters.store"), {
    onSuccess: () => {
      emit("close");
    },
  });
};

</script>

<template>
  <div
    class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
  >
    <div class="bg-secondary p-6 rounded shadow-lg">
      <div class="flex justify-between items-center mb-5 pb-3 border-b border-primary/70">
        <h2 class="text-xl font-bold">Create New Character</h2>
        <button @click="$emit('close')" class="cursor-pointer">&#10006;</button>
      </div>
      <form @submit.prevent="submit">
        <div class="flex flex-col justify-center items-start gap-3">
          <div class="grid grid-cols-2 gap-3">
            <CreateModalField>
              <CreateModalLabel htmlFor="name">Name</CreateModalLabel>
              <CreateModalInput
                v-model="form.name"
                type="text"
                id="name"
                name="name"
                placeholder="Bradley"
              />
            </CreateModalField>

            <CreateModalField>
              <CreateModalLabel htmlFor="race">Race</CreateModalLabel>
              <CreateModalInput
                v-model="form.race"
                type="text"
                id="race"
                name="race"
                placeholder="Human"
              />
            </CreateModalField>

            <CreateModalField>
              <CreateModalLabel htmlFor="class">Class</CreateModalLabel>
              <CreateModalInput
                v-model="form.class"
                type="text"
                id="class"
                name="class"
                placeholder="Wizard"
              />
            </CreateModalField>

            <CreateModalField>
              <CreateModalLabel htmlFor="alignment">Alignment</CreateModalLabel>
              <CreateModalInput
                v-model="form.alignment"
                type="text"
                id="alignment"
                name="alignment"
                placeholder="Good"
              />
            </CreateModalField>

            <CreateModalField>
              <CreateModalLabel htmlFor="backstory">Backstory</CreateModalLabel>
              <CreateModalTextArea
                v-model="form.backstory"
                type="text"
                id="backstory"
                name="backstory"
                placeholder="Once upon a time..."
                class="pt-3"
              />
            </CreateModalField>

            <div class="grid grid-cols-3 place-content-center text-center gap-y-5">
              <div class="grid place-content-center gap-1">
                <CreateModalLabel htmlFor="max_hp">Max HP</CreateModalLabel>
                <CreateModalInputNumber id="max_hp" min="1" max="99" step="1" v-model="form.max_hp" />
              </div>
              <div class="grid place-content-center gap-1">
                <CreateModalLabel htmlFor="armor_class">Armour Class</CreateModalLabel>
                <CreateModalInputNumber id="armor_class" min="1" max="99" step="1" v-model.number="form.armor_class" />
              </div>
              <div class="grid place-content-center gap-1">
                <CreateModalLabel htmlFor="speed">Speed</CreateModalLabel>
                <CreateModalInputNumber id="speed" min="1" max="99" step="1" v-model.number="form.speed" />
              </div>
              <div class="grid place-content-center gap-1">
                <CreateModalLabel htmlFor="strength">Strength</CreateModalLabel>
                <CreateModalInputNumber id="strength" min="1" max="99" step="1" v-model.number="form.strength" />
              </div>
              <div class="grid place-content-center gap-1">
                <CreateModalLabel htmlFor="initiative">Initiative</CreateModalLabel>
                <CreateModalInputNumber id="initiative" min="1" max="99" step="1" v-model.number="form.initiative" />
              </div>
            </div>
          </div>

          <div v-if="form.errors.name">
            <p class="text-red-500 text-sm">
              {{ form.errors.name }}
            </p>
          </div>
          <div v-if="form.errors.backstory">
            <p class="text-red-500 text-sm">
              {{ form.errors.backstory }}
            </p>
          </div>

          <div class="w-full flex justify-between mt-3">
            <button
              type="button"
              @click="$emit('close')"
              class="border rounded border-primary/70 bg-primary hover:bg-primary/70 transition-colors duration-300 cursor-pointer text-sm py-2 px-4"
            >
              Cancel
            </button>
            <button
              type="submit"
              :disabled="form.processing"
              class="border rounded border-primary/70 bg-primary hover:bg-primary/70 transition-colors duration-300 cursor-pointer text-sm py-2 px-4"
            >
              Create Character
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
