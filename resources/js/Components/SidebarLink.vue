<template>
  <Link :href="href" :class="['flex items-center p-3 rounded-lg transition duration-150 ease-in-out', active ? 'bg-blue-600 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600']">
    <slot name="icon" class="w-5 h-5 mr-3"></slot>
    <span class="ml-3 text-sm font-medium"><slot /></span>
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
  href: String,
  active: Boolean,
});
</script>