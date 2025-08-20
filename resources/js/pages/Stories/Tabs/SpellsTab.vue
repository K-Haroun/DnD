<script setup>
defineProps(['story'])

</script>

<template>
    <div v-if="story.characters && story.characters.length"
        class="grid grid-cols-5 gap-5 mx-20">
        <!-- user's spells -->
        <div v-for="spell in story.characters[0].spells" :key="spell.id" class="basis-50 border p-5 text-sm bg-primary rounded overflow-auto">
            <h2 class="text-center text-lg font-bold mb-3">{{ spell.name }}</h2>
            <ul>
                <li>
                    <p>Name: {{ spell.name }}</p>
                </li>
                <li>
                    <p>Quantity: {{ spell.quantity }}</p>
                </li>
                <li>
                    <p>Description: {{ spell.description }}</p>
                </li>
            </ul>
        </div>
    </div>
    <div v-else class="grid h-full place-content-center">
        <h2 class="text-xl">Your character has no spells!</h2>
    </div>
</template>