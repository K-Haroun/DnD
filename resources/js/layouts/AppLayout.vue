<script setup>
import AppLayout from "@/layouts/app/AppSidebarLayout.vue";
import { usePage } from "@inertiajs/vue3";
import { ref, watch, computed } from "vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

withDefaults(defineProps(), {
  breadcrumbs: () => [],
});

</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <slot />
  </AppLayout>
</template>
