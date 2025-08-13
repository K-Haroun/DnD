<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import StoriesBox from '@/components/stories/StoriesBox.vue';
import Button from '@/components/ui/button/Button.vue';
import Pagination from '@/components/ui/pagination/Pagination.vue';
import CreateModal from './Create/CreateModal.vue'
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Stories',
        href: '/stories',
    },
];

const showModal = ref(false)
const modalProps = ref({})

const openModal = () => showModal.value = true

const page = usePage()

defineProps(['stories']);
</script>

<template>
  <Head title="Stories" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-1 flex-col gap-1 my-5 mx-10">
      <div class="flex gap-3 text-sm mb-2">
        <Button @click="openModal"> Create Story </Button>
        <CreateModal v-if="showModal" @close="showModal = false" />

        <Button>
          <Link href="route('stories.join')"> Join Story </Link>
        </Button>
      </div>
      <Link
        v-if="$page.props.auth.user"
        v-for="story in stories.data"
        :href="route('stories.show', story.id)"
      >
        <StoriesBox>
          {{ story.title }}
        </StoriesBox>
      </Link>
    </div>

    <Pagination :meta="stories.meta" :links="stories.links" />
  </AppLayout>
</template>
