<script setup lang="ts">
  import CreateModalField from "./CreateModalField.vue";
  import CreateModalInput from "./CreateModalInput.vue";
  import CreateModalLabel from "./CreateModalLabel.vue";
</script>

<template>
  <div
    class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
  >
    <div class="bg-primary p-6 rounded shadow-lg w-[500px]">
      <h2 class="text-xl font-bold mb-4">Create Story</h2>
      <!-- form -->
      <form action="">
        <div class="flex flex-col">
          <CreateModalField class="flex flex-col my-5">
            <CreateModalLabel :for="'title'">Title</CreateModalLabel>
            <CreateModalInput :type="'text'" :id="'title'" :name="'title'" />
          </CreateModalField>

          <div>
            <label for="plot">Plot</label>
            <input type="text" />
          </div>

          <div>
            <label for="map"></label>
            <input type="file" />
          </div>
        </div>
      </form>
      <button @click="$emit('close')">Close</button>
    </div>
  </div>
</template>
