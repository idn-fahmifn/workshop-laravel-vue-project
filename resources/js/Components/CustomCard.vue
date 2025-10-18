<template>
  <div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex justify-between items-center mb-4" v-if="title">
      <h3 class="text-lg font-semibold text-gray-800">{{ title }}</h3>
      <slot name="actions"></slot>
    </div>
    <slot />
  </div>
</template>

<script setup>
defineProps({
  title: String,
});
</script>