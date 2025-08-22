<script setup>


defineProps(["id", "min", "max"]);

const number = defineModel();
const decrement = () => number.value > 1 && number.value--;
const increment = () => number.value < 99 && number.value++;

</script>

<template>
  <div class="relative flex justify-center items-center max-w-[8rem]">
    <button
      type="button"
      id="decrement-button"
      data-input-counter-decrement="quantity-input"
      @click="decrement"
      class="bg-primary/70 dark:bg-primary/70 dark:hover:bg-primary dark:border-primary hover:bg-primary border border-primary rounded-s-lg p-1 h-5 focus:ring-primary dark:focus:ring-primary focus:ring-2 focus:outline-none"
    >
      <svg
        class="size-2 text-gray-900 dark:text-white"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 18 2"
      >
        <path
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M1 1h16"
        />
      </svg>
    </button>
    <input
      type="number"
      :id="id"
      data-input-counter
      :data-input-counter-min="min"
      :data-input-counter-max="max"
      aria-describedby="Health Points"
      class="bg-primary/70 border-x-0 border-primary h-5 px-0 text-center text-gray-900 text-xs focus:ring-primary focus:border-primary block w-4/12 py-2.5 dark:bg-primary/70 dark:border-primary dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary"
      v-model="number"
      required
    />
    <button
      type="button"
      id="increment-button"
      data-input-counter-increment="quantity-input"
      @click="increment"
      class="bg-primary/70 dark:bg-primary/70 dark:hover:bg-primary dark:border-primary hover:bg-primary border border-primary rounded-e-lg p-1 h-5 focus:ring-primary dark:focus:ring-primary focus:ring-2 focus:outline-none"
    >
      <svg
        class="size-2 text-gray-900 dark:text-white"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 18 18"
      >
        <path
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M9 1v16M1 9h16"
        />
      </svg>
    </button>
  </div>
</template>
