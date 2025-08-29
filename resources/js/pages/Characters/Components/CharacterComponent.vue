<script setup>
import {
  UserPlus,
  Shapes,
  ArrowBigUpDash,
  Cat,
  SmilePlus,
  HeartPulse,
} from "lucide-vue-next";
const props = defineProps(["character", "charAttrs"]);
</script>
<template>
  <div class="border-2 border-secondary rounded p-3 m-3 font-bold">
    <div class="flex justify-between items-center w-65">
      <h2 class="text-lg">{{ character.name.toUpperCase() }}</h2>
      <ul class="flex gap-2 text-lg">
        <li class="flex gap-1 items-center">
          <ArrowBigUpDash class="size-5" />
          <p>
            {{ character.level }}
          </p>
        </li>
        <li class="flex gap-1 items-center">
          <HeartPulse class="size-5" />
          <p>
            {{ character.current_hp }}
          </p>
        </li>
      </ul>
    </div>
    <div class="border-1 border-secondary rounded py-2 px-1 uppercase-text">
      <div>
        <div>
          <ul>
            <li v-for="attr in charAttrs" class="flex items-center gap-1 my-2">
              <component :is="attr.icon" class="size-4" />
              <p>{{ character[attr.title].toUpperCase() }}</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
