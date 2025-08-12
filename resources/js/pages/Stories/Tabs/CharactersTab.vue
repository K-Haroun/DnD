<script setup>
    defineProps(['story'])
</script>

<template>
    <div>
        <div v-if="story.characters && story.characters.length" v-for="character in story.characters"
            :key="character.id" class="flex mx-20">
            <!-- user's character -->
            <div class="basis-50 border p-5 text-sm bg-primary rounded">
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
    </div>
</template>