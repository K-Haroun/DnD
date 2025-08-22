<script setup>
import { UserPlus } from 'lucide-vue-next';
import Button from "@/components/ui/button/Button.vue";
import { ref } from 'vue';
import CreateCharacterModal from '@/pages/Characters/Create/CreateCharacterModal.vue';

defineProps(['story']);

const showModal = ref(false);

const openModal = () => (showModal.value = true);
</script>

<template>
    <div class="grid grid-cols-5 gap-5 mx-20">
        <!-- Characters -->
        <Button @click="openModal" class="border border-primary shadow-sm h-55 w-35 grid place-content-center text-primary bg-secondary hover:shadow-lg hover:bg-primary/5 hover:text-primary-foreground transition-all duration-300 cursor-pointer">
            <UserPlus class="size-20"/>
        </Button>
        <CreateCharacterModal v-if="showModal" @close="showModal = false" :story="story"/>
        <div v-if="story.characters && story.characters.length" v-for="character in story.characters" :key="character.id" class="basis-50 border p-5 text-sm bg-primary rounded">
            <h2 class="text-center text-lg font-bold mb-3">{{ character.name }}</h2>
            <ul>
                <li>
                    <p>Class: {{ character.class }}</p>
                </li>
                <li>
                    <p>Level: {{ character.level }}</p>
                </li>
                <li>
                    <p>Max HP: {{ character.max_hp }}</p>
                </li>
                <li>
                    <p>Armor Class: {{ character.armor_class }}</p>
                </li>
                <li>
                    <p>Speed: {{ character.speed }}</p>
                </li>
                <li>
                    <p>Strength: {{ character.strength }}</p>
                </li>
                <li>
                    <p>Initiative: {{ character.initiative }}</p>
                </li>
                <li>
                    <p>Alignment: {{ character.alignment }}</p>
                </li>
            </ul>
        </div>
    </div>
</template>