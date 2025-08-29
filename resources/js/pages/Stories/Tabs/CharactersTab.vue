<script setup>
import {
  UserPlus,
  Shapes,
  ArrowBigUpDash,
  Cat,
  SmilePlus,
  HeartPulse,
} from "lucide-vue-next";
import { ref } from "vue";
import EditCharacterModal from "@/pages/Characters/Edit/EditCharacterModal.vue";
import CharacterComponent from "@/pages/Characters/Components/CharacterComponent.vue";
import { usePage } from "@inertiajs/vue3";

defineProps(["story"]);

const activeCharacter = ref(null);
const page = usePage();
const user = page.props.auth.user

const openModal = (character) => {
  if (character.user.id == user.id) {
    activeCharacter.value = character;
  }
};

const closeModal = () => {
  activeCharacter.value = null;
};

const charAttrs = [
  {
    title: "class",
    icon: Shapes,
  },
  {
    title: "race",
    icon: Cat,
  },
  {
    title: "alignment",
    icon: SmilePlus,
  },
];
</script>

<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mx-auto text-secondary w-fit h-full">
    <EditCharacterModal
      v-if="activeCharacter"
      @close="closeModal"
      :character="activeCharacter"
      :story="story"
    />
    <div
      v-if="story.characters && story.characters.length"
      v-for="character in story.characters"
      :key="character.id"
      @click="openModal(character)"
      class="h-fit w-fit border text-xs bg-tertiary rounded"
    >
      <CharacterComponent :character="character" :charAttrs="charAttrs" />
    </div>
  </div>
</template>
