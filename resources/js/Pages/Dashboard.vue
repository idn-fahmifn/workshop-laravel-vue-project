<script setup>
// Asumsi: AuthenticatedLayout sudah mengurus Sidebar/Navbar utama
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'; 
import { Head } from '@inertiajs/vue3';
// Asumsi: InfoCard dan CustomCard sudah Anda implementasikan di file ini
// Kita akan mempertahankan data dummy di sini

const props = defineProps({
    data : Object
});


const total = {
  'all' : props.data.all,
  'completed' : props.data.completed,
  'pending' : props.data.pending,
  'high' : props.data.high,
}

const infoCardsData = [
  { title: 'All Tasks', value: total.all, iconBg: 'bg-blue-500' },
  { title: 'Completed Tasks', value: total.completed, iconBg: 'bg-green-500' },
  { title: 'Pending Tasks', value: total.pending, iconBg: 'bg-yellow-500' },
  { title: 'High Priority Task', value: total.high, iconBg: 'bg-red-500' },
];



// ... (Jika ada data chart atau komponen lain, pertahankan di sini)
</script>

<template>
  <AuthenticatedLayout title="Dashboard">
    <Head title="Dashboard" />

    {{ console.log(props) }}

    
    <div class="py-8 px-6 lg:px-8 bg-gray-50 min-h-screen">
      <h1 class="text-3xl font-bold text-gray-900 mb-6">Dashboard Overview</h1>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div v-for="(card, index) in infoCardsData" :key="index" 
             class="bg-white rounded-xl shadow-sm p-6 flex items-center justify-between transition-all duration-300 hover:shadow-lg">
            <div>
              
              <p class="text-sm font-medium text-gray-500">{{ card.title }}</p>
              <p class="text-3xl font-bold text-gray-900 mt-1">{{ card.value }}</p>   
            </div>
            <div :class="['p-3 rounded-full', card.iconBg]">
            </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>