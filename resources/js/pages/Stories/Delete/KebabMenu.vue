<script setup>
import { Link } from '@inertiajs/vue3';

  defineProps(['story']);
</script>

<template>
  <button
    id="dropdownMenuIconButton"
    data-dropdown-toggle="dropdownDots"
    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-primary/50 rounded-lg hover:bg-gray-100 hover:cursor-pointer focus:outline-none dark:text-white dark:bg-secondary dark:hover:bg-primary/50"
    type="button"
  >
    <svg
      class="w-5 h-5"
      aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg"
      fill="currentColor"
      viewBox="0 0 4 15"
    >
      <path
        d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"
      />
    </svg>
  </button>

  <!-- Dropdown menu -->
  <div
    id="dropdownDots"
    class="z-10 hidden bg-primary divide-y divide-gray-100 rounded-lg shadow-sm w-fit dark:bg-primary/70 dark:divide-gray-600"
  >
    <ul
      class="py-2 text-sm text-gray-700 dark:text-gray-200"
      aria-labelledby="dropdownMenuIconButton"
    >
      <li>
        <Link
          method="delete"
          :href="route('stories.delete', story)"
          class="block px-4 py-1 hover:text-destructive"
          as="button"
          >Delete Story</Link
        >
      </li>
    </ul>
  </div>
</template>
