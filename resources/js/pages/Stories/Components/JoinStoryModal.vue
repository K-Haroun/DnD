<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import Button from "@/components/ui/button/Button.vue";

const joinCode = ref("");
const formErrors = ref([]);
const emit = defineEmits("close");

function submitJoin() {
  router.post(
    route("stories.joinWithCode"),
    { join_code: joinCode.value }, // data
    {
      onSuccess: () => {
        emit("close");
        joinCode.value = ""; // reset after successful join
      },
      onError: (errBag) => {
        joinCode.value = "";
        formErrors.value = Object.values(errBag).flat();
      },
    }
  );
}

</script>
<template>
  <div
    @click.self="$emit('close')"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
  >
    <div class="p-5 bg-primary border rounded-lg">
      <div class="flex justify-between items-center mb-3 text-xl">
        <h2>Join Story</h2>
        <button @click="$emit('close')" class="cursor-pointer">&#10006;</button>
      </div>
      <div class="grid place-content-center border rounded-md p-7 w-100 bg-secondary">
        <form @submit.prevent="submitJoin">
          <input
            v-model="joinCode"
            placeholder="Enter join code"
            class="border px-2 py-1 bg-primary/20"
            required
          />
          <Button size="sm" type="submit" class="ml-2 bg-primary"> Join </Button>
        </form>
      </div>
      <div v-if="formErrors.length" class="mt-3">
        <p v-for="(error, idx) in formErrors" :key="idx" class="text-red-500 text-sm">
          {{ error }}
        </p>
      </div>
    </div>
  </div>
</template>
