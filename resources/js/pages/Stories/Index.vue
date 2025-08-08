<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../../components/PlaceholderPattern.vue';
import StoriesBox from '@/components/stories/StoriesBox.vue';

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
        <StoriesBox v-if="$page.props.auth.user">
            {{ stories[0].title }}
        </StoriesBox>
    </AppLayout>
</template>