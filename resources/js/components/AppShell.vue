<script setup>
import { SidebarProvider } from '@/components/ui/sidebar';
import { usePage } from '@inertiajs/vue3';
import { watch, computed, onMounted } from "vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const isOpen = usePage().props.sidebarOpen;
const page = usePage();
const flash = computed(() => page.props.flash);

// Show toast if flash already exists when component mounts
onMounted(() => {
  if (flash.value?.success) {
    toast.success(flash.value.success)
  }
  if (flash.value?.error) {
    toast.error(flash.value.error)
  }
})

// Also watch for changes (if another Inertia visit sets flash later)
watch(
  () => flash.value,
  (newFlash, oldFlash) => {
    if (newFlash?.success && newFlash?.success !== oldFlash?.success) {
      toast.success(newFlash.success)
    }
    if (newFlash?.error && newFlash?.error !== oldFlash?.error) {
      toast.error(newFlash.error)
    }
  }
)

</script>

<template>
    <div v-if="variant === 'header'" class="flex min-h-screen w-full flex-col">
        <slot />
    </div>
    <SidebarProvider v-else :default-open="isOpen">
        <slot />
    </SidebarProvider>
</template>
