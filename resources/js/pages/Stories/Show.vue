<script setup>
import AppLayout from "@/layouts/AppLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import CharactersTab from "./Tabs/CharactersTab.vue";
import InventoryTab from "./Tabs/InventoryTab.vue";
import SpellsTab from "./Tabs/SpellsTab.vue";
import MapTab from "./Tabs/MapTab.vue";

const breadcrumbs = [
  {
    title: "Story",
    href: "/story",
  },
];

defineProps(["story", "isGameMaster"]);

const currentTab = ref("characters");

const tabs = {
  characters: CharactersTab,
  inventory: InventoryTab,
  spells: SpellsTab,
  map: MapTab,
};

const continueStory = ref(false);
</script>

<template>
  <Head title="Story" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="my-10">
      <div class="text-center text-4xl mt-10 text-shadow-lg">
        {{ story.title }}
      </div>
      <div class="my-18 flex flex-col justify-center items-center gap-12 px-20">
        <div
          v-if="!continueStory"
          class="p-10 border h-70 overflow-auto bg-primary/50 shadow-2xl"
        >
          <!-- plot -->
          {{ story.plot }}
        </div>
        <div v-else class="relative w-[100%]">
            <textarea
            name="plot"
            id="plot"
            class="resize-none focus:outline-none p-10 border h-70 w-[100%] overflow-auto bg-primary/70 shadow-2xl"
            >{{ story.plot }}</textarea>
            <div class="absolute self-baseline bottom-2 flex justify-between h-10 w-[100%] bg-primary">
                <div class="w-12"></div>
                <div class="flex items-center">
                    <span>Writing plot...</span>
                </div>
                <form action="">
                    <button @click="continueStory = false" class="border px-2 bg-secondary-foreground text-sm text-primary font-bold cursor-pointer">
                        Done
                    </button>
                </form>
            </div>
        </div>

        <div v-if="isGameMaster">
          <button
            @click="continueStory = true"
            class="border rounded py-2 px-4 border-primary/70 bg-primary/70 hover:bg-primary transition-colors duration-300"
          >
            Continue Story
          </button>
        </div>
      </div>

      <div class="border"></div>

      <div>
        <div class="flex justify-center text-sm">
          <button
            v-for="(label, key) in {
              characters: 'Characters',
              inventory: 'Inventory',
              spells: 'Spells',
              map: 'Map',
            }"
            @click="currentTab = key"
            :class="[
              'w-30 py-1 text-center border',
              currentTab === key ? 'bg-accent-tab/70' : 'bg-primary',
            ]"
          >
            {{ label }}
          </button>
        </div>
        <div class="pt-10 h-100">
          <component :is="tabs[currentTab]" :story="story" />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
