<script setup>
import AppLayout from "@/layouts/AppLayout.vue";
import { Head, Link, usePage, router } from "@inertiajs/vue3";
import StoriesBox from "@/components/stories/StoriesBox.vue";
import Button from "@/components/ui/button/Button.vue";
import Pagination from "@/components/ui/pagination/pagination.vue";
import CreateStoryModal from "./Create/CreateStoryModal.vue";
import { ref } from "vue";
import JoinStoryModal from "./Components/JoinStoryModal.vue";

const breadcrumbs = [
  {
    title: "Stories",
    href: "/stories",
  },
];

const showCreateModal = ref(false);
const showJoinModal = ref(false);

const openCreateModal = () => (showCreateModal.value = true);
const openJoinModal = () => (showJoinModal.value = true);

defineProps(["stories"]);
</script>

<template>
  <Head title="Stories" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-1 flex-col gap-1 my-5 mx-10">
      <div class="flex gap-3 text-sm mb-2">
        <Button @click="openCreateModal"> Create Story </Button>
        <CreateStoryModal v-if="showCreateModal" @close="showCreateModal = false" />

        <Button @click="openJoinModal"> Join Story </Button>
        <JoinStoryModal v-if="showJoinModal" @close="showJoinModal = false" />
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
