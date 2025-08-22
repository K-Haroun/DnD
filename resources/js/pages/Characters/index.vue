<script setup>
import AppLayout from "@/layouts/AppLayout.vue";
import { Drama } from "lucide-vue-next";

const breadcrumbs = [
  {
    title: "Stories",
    href: "/stories",
  },
];

defineProps(["characters"]);

</script>

<template>
  <Head title="Characters" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-1 flex-col gap-1 my-5 mx-10">
      <div
        v-if="!characters.length"
        class="h-full grid space-y-5 place-content-center text-center"
      >
        <Drama class="size-20 mx-auto" />
        <h2 class="text-xl">You have no characters</h2>
        <h2 class="text-lg">Join a story to create a character!</h2>
      </div>
      <div v-else class="flex flex-1 flex-col gap-1 my-5 mx-10">
        <div v-for="character in characters">
          <h2>{{ character.name }}</h2>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
