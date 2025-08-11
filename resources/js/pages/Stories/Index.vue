<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import StoriesBox from '@/components/stories/StoriesBox.vue';
import Button from '@/components/ui/button/Button.vue';
import Pagination from '@/components/ui/pagination/pagination.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Stories',
        href: '/stories',
    },
];

defineProps(['stories']);

</script>

<template>

    <Head title="Stories" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-1 my-5 mx-10">
            <div class="flex gap-3 text-sm mb-2">
                <Button>
                    Create Story
                </Button>
                <Button>
                    Join Story
                </Button>
            </div>
            <Link v-if="$page.props.auth.user" v-for="story in stories.data" :href="`/stories/${story.id}`">
                <StoriesBox>
                    {{ story.title }}
                </StoriesBox>
            </Link>
        </div>


        <Pagination :meta="stories.meta" />
    </AppLayout>
</template>