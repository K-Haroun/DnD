<script setup>
defineProps(['story'])

</script>

<template>
    <div v-if="story.characters && story.characters.length"
        class="grid grid-cols-5 gap-5 mx-20">
        <!-- user's items -->
        <div v-for="item in story.characters[0].items" :key="item.id" class="basis-50 border p-5 text-sm bg-primary rounded overflow-auto">
            <h2 class="text-center text-lg font-bold mb-3">{{ item.name }}</h2>
            <ul>
                <li>
                    <p>Name: {{ item.name }}</p>
                </li>
                <li>
                    <p>Quantity: {{ item.quantity }}</p>
                </li>
                <li>
                    <p>Description: {{ item.description }}</p>
                </li>
            </ul>
        </div>
    </div>
</template>