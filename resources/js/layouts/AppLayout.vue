<script setup>
import AppLayout from "@/layouts/app/AppSidebarLayout.vue";
import { usePage } from "@inertiajs/vue3";
import { ref, Transition, watch } from "vue";

withDefaults(defineProps(), {
  breadcrumbs: () => [],
});

const page = usePage();
const showMessage = ref(false);
const messageContent = ref("");

watch(
  () => page.props.flash.message,
  (newMessage) => {
    if (newMessage) {
      showMessage.value = true;
      messageContent.value = newMessage;
      // Hide the message after 3 seconds
      setTimeout(() => {
        showMessage.value = false;
      }, 3000);
    }
  },
  { immediate: true }
);
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <Transition name="slide-fade">
      <div
        v-if="showMessage"
        class="fixed top-0 left-1/2 -translate-x-1/2 z-50 mt-4 p-4 rounded-md shadow-lg text-white"
        :class="{ 'bg-green-500': messageContent }"
      >
        {{ messageContent }}
      </div>
    </Transition>

    <slot />
  </AppLayout>
</template>

<style scoped>
.slide-fade-enter-active {
  transition: all 0.5s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateY(-50px);
  opacity: 0;
}
</style>
