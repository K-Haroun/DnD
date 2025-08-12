<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue'
import CharactersTab from './Tabs/CharactersTab.vue'
import InventoryTab from './Tabs/InventoryTab.vue'
import SpellsTab from './Tabs/SpellsTab.vue'
import MapTab from './Tabs/MapTab.vue'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Story',
        href: '/story',
    },
];

defineProps(['story']);

const currentTab = ref('characters')

const tabs = {
    characters: CharactersTab,
    inventory: InventoryTab,
    spells: SpellsTab,
    map: MapTab,
}

</script>

<template>

    <Head title="Story" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="my-10">
            <div class="text-center text-4xl mt-10 text-shadow-lg">
                {{ story.title }}
            </div>
            <div class="my-20 flex px-20">
                <div v-if="story.characters" class="p-10 border h-70 overflow-auto bg-primary/50 shadow-2xl">
                    <!-- plot -->
                    {{ story.plot }}
                </div>
            </div>

            <div class="border">

            </div>

            <div>
                <div class="flex justify-center text-sm">
                    <button
                        v-for="(label, key) in { characters: 'Characters', inventory: 'Inventory', spells: 'Spells', map: 'Map' }"
                        @click="currentTab = key" :class="['w-30 py-1 text-center border',
                            currentTab === key ? 'bg-accent-tab/70' : 'bg-primary'
                        ]">
                        {{ label }}
                    </button>
                </div>
                <div class="grid place-content-start pt-20">
                    <component :is="tabs[currentTab as keyof typeof tabs]" :story="story" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>