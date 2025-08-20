<script setup>
import AppLayout from "@/layouts/AppLayout.vue";

const breadcrumbs = [
    {
        title: 'Stories',
        href: '/stories',
    },
];

defineProps(['Characters'])

</script>

<template>
  <Head title="Characters" />
  <AppLayout :breadcrumbs="breadcrumbs">
  <div class="flex flex-1 flex-col gap-1 my-5 mx-10">
    Hello from characters!
  </div>
  </AppLayout>
</template>
