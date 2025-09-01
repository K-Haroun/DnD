<script setup>
import AppLayout from "@/layouts/AppLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { computed, ref, Transition } from "vue";
import CharactersTab from "./Tabs/CharactersTab.vue";
import InventoryTab from "./Tabs/InventoryTab.vue";
import SpellsTab from "./Tabs/SpellsTab.vue";
import MapTab from "./Tabs/MapTab.vue";
import { UserPlus, NotebookPen, Plus } from "lucide-vue-next";

const breadcrumbs = [
  {
    title: "Story",
    href: "/story",
  },
];

const props = defineProps(["story", "isGameMaster"]);
const isGameMaster = ref(props.isGameMaster);
const currentTab = ref("characters");
const joinCodeSlide = ref(false);
const showNotes = ref(false);
const createNote = ref(false);

const tabs = {
  characters: CharactersTab,
  inventory: InventoryTab,
  spells: SpellsTab,
  map: MapTab,
};

const continueStory = ref(false);

const plotForm = useForm({
  plot: props.story.plot,
});

const submitPlotForm = () => {
  plotForm.patch(route("stories.update", props.story), {
    preserveScroll: true,
    onFinish: () => {
      plotForm.reset();
      continueStory.value = false;
      showNotes.value = false;
    },
  });
};

const noteForm = useForm({
  note: "",
  story_id: props.story.id,
});

const submitNoteForm = () => {
  noteForm.post(route("notes.store", noteForm), {
    preserveScroll: true,
    onFinish: () => {
      noteForm.reset();
      continueStory.value = false;
      showNotes.value = true;
    },
  });
};

const openNotes = () => {
  showNotes.value = !showNotes.value;
};

const addNote = () => {
  createNote.value = true;
};
</script>

<template>
  <Head title="Story" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="relative my-10">
      <div class="absolute right-10">
        <!-- <KebabMenu v-if="isGameMaster" :story="props.story" /> -->
        <div class="w-fit flex flex-col justify-center items-end gap-5">
          <div v-if="isGameMaster">
            <button
              @click="joinCodeSlide = !joinCodeSlide"
              class="border-1 rounded-full border-white p-2 hover:bg-primary hover:border-primary cursor-pointer transition-colors duration-300"
            >
              <div class="flex items-center gap-2">
                <UserPlus class="size-5 text-white" />
                <Transition name="slide">
                  <p v-if="joinCodeSlide" class="text-sm whitespace-nowrap">
                    Join Code: {{ story.join_code }}
                  </p>
                </Transition>
              </div>
            </button>
          </div>
        </div>
      </div>
      <div class="flex flex-col justify-center items-center gap-12 px-20 pb-10">
        <div class="text-center text-4xl text-shadow-lg mx-auto">
          {{ story.title }}
        </div>
        <div
          v-if="!continueStory && !showNotes"
          class="relative p-10 border h-100 overflow-y-auto wrap-break-word bg-primary/50 shadow-2xl w-full"
        >
          <!-- notes toggle-->
          <button @click="openNotes" class="absolute top-2 right-2 cursor-pointer">
            <NotebookPen />
          </button>

          <!-- plot -->
          <p>
            {{ story.plot }}
          </p>
        </div>
        <div v-else-if="continueStory" class="relative w-full">
          <form id="plot-form" @submit.prevent="submitPlotForm">
            <textarea
              name="plot"
              id="plot"
              v-model="plotForm.plot"
              class="resize-none focus:outline-none p-10 border h-100 w-full overflow-auto bg-primary/70 shadow-2xl"
            />
            <div
              class="absolute self-baseline bottom-2 flex justify-between h-10 w-[100%] bg-primary"
            >
              <div class="w-12"></div>
              <div class="flex items-center">
                <span>Writing plot...</span>
              </div>
              <button
                form="plot-form"
                type="submit"
                :disabled="plotForm.processing"
                class="h-full border px-2 bg-secondary-foreground text-sm text-primary font-bold cursor-pointer"
                preserve-scroll
              >
                Done
              </button>
            </div>
          </form>
        </div>
        <div
          v-else-if="showNotes"
          class="relative p-10 border h-100 overflow-y-auto wrap-break-word bg-primary/50 shadow-2xl w-full"
        >
          <div class="absolute top-2 right-2 text-primary space-x-2">
            <button @click="addNote" class="cursor-pointer">
              <Plus class="text-white" />
            </button>
            <button @click="openNotes" class="cursor-pointer">
              <NotebookPen class="hover:text-primary" />
            </button>
          </div>

          <!-- notes -->
          <div v-if="story.notes && story.notes.length" class="flex gap-3">
            <div
            v-for="note in story.notes"
            :key="note.id"
              class="h-50 w-50 p-3 bg-tertiary/50 text-white border-2 border-secondary overflow-auto text-xs shadow-sm"
            >
              <p>
                {{ note.note }}
              </p>
            </div>

            <!-- add new note -->
            <form id="note-form" @submit.prevent="submitNoteForm">
              <div
                v-if="createNote"
                class="relative h-50 w-50 bg-tertiary/50 text-white border-2 border-secondary overflow-auto text-xs shadow-sm"
              >
                <textarea
                  name="note"
                  id="note"
                  v-model="noteForm.note"
                  class="absolute resize-none focus:border-white h-full w-full bg-transparent text-white border-secondary overflow-auto text-xs"
                />
                <button
                  form="note-form"
                  type="submit"
                  :disabled="noteForm.processing"
                  class="absolute bottom-0 right-0 border px-2 bg-secondary-foreground text-sm text-primary font-bold cursor-pointer"
                  preserve-scroll
                >
                  Done
                </button>
              </div>
            </form>
          </div>
        </div>

        <div v-if="isGameMaster && !continueStory">
          <button
            @click="continueStory = true"
            class="border rounded py-2 px-4 border-primary/70 bg-primary/70 hover:bg-primary transition-colors duration-300"
          >
            Continue Story
          </button>
        </div>
        <span v-if="isGameMaster && continueStory" class="block h-8"></span>
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

<style scoped>
.slide-enter-active,
.slide-leave-active {
  transition: all 0.8s ease;
}
.slide-enter-from,
.slide-leave-to {
  opacity: 0;
  max-width: 0;
  transform: translateX(10px);
  overflow: hidden;
}
.slide-enter-to,
.slide-leave-from {
  color: white;
  opacity: 1;
  max-width: 200px;
  transform: translateX(0);
  overflow: hidden;
}
</style>
