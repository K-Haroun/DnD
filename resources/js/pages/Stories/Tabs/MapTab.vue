<script setup>
defineProps(["story"]);
</script>

<template>
  <div class="flex flex-1 h-full justify-center items-center">
    <div class="max-w-[500px] m-auto">
      <img
        v-if="story.map_url"
        :src="story.map_url"
        :alt="story.title"
        class="w-[100%] h-auto"
      />
    </div>
  </div>
</template>