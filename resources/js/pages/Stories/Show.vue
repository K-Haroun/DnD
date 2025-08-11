<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import StoriesBox from '@/components/stories/StoriesBox.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Story',
        href: '/story',
    },
];

defineProps(['story']);

</script>

<template>
    <Head title="Story" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="my-10">
            <div class="text-center text-4xl mb-10">
                {{ story.title }}
            </div>
            <div class="h-full flex items-center gap-10 px-20">
                <div v-if="story.characters" class="basis-120 p-10 border overflow-auto bg-primary/50 shadow-2xl">
                    <!-- plot -->
                    {{ story.plot }}
                </div>
                <div v-if="story.characters && story.characters.length" class="basis-50 border p-7 text-sm bg-primary/50">
                    <!-- user's character -->
                     <h2 class="text-center text-lg font-bold mb-3">{{ story.characters[0].name }}</h2>
                     <ul class="">
                        <li>
                            <p>Class: {{ story.characters[0].class }}</p>
                        </li>
                        <li>
                            <p>Level: {{ story.characters[0].level }}</p>
                        </li>
                        <li>
                            <p>Max HP: {{ story.characters[0].max_hp }}</p>
                        </li>
                        <li>
                            <p>Armor Class: {{ story.characters[0].armor_class }}</p>
                        </li>
                        <li>
                            <p>Speed: {{ story.characters[0].speed }}</p>
                        </li>
                        <li>
                            <p>Strength: {{ story.characters[0].strength }}</p>
                        </li>
                        <li>
                            <p>Initiative: {{ story.characters[0].initiative }}</p>
                        </li>
                        <li>
                            <p>Alignment: {{ story.characters[0].alignment }}</p>
                        </li>
                     </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>