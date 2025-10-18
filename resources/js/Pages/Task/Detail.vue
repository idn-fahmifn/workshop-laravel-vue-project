<script setup>
// Mengimpor komponen bawaan
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'; // Import useForm untuk aksi DELETE
import PrimaryButton from '@/Components/PrimaryButton.vue';

// Menerima props 'task' dari TaskController@show
const props = defineProps({
    task: {
        type: Object,
        required: true,
    },
});

// Form untuk aksi DELETE
const formDelete = useForm({});

const deleteTask = () => {
    if (confirm('Apakah Anda yakin ingin menghapus tugas ini secara permanen?')) {
        formDelete.delete(route('task.destroy', props.task.id));
    }
};

// --- Fungsi Helper untuk Tampilan UI ---

// Mendapatkan style badge berdasarkan status completion
const getStatusBadgeClasses = (isCompleted) => {
    return isCompleted
        ? 'bg-green-100 text-green-800' // Selesai
        : 'bg-yellow-100 text-yellow-800'; // Tertunda
};

// Mendapatkan style badge berdasarkan priority
const getPriorityBadgeClasses = (priority) => {
    const map = {
        'low': 'bg-blue-100 text-blue-800',
        'medium': 'bg-yellow-100 text-yellow-800',
        'high': 'bg-red-100 text-red-800',
    };
    return map[priority] || 'bg-gray-100 text-gray-800';
};

// Mengubah format tanggal
const formatDate = (timestamp) => {
    if (!timestamp) return 'N/A';
    // Gunakan prop.task.due_date, yang di-cast Laravel sebagai Date object, atau created_at/updated_at
    const date = new Date(timestamp);
    return date.toLocaleDateString('en-EN', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
};

</script>

<template>
    <AuthenticatedLayout title="Task Detail"> 

        <Head :title="`Detail: ${task.task_name}`" />

        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Detail Tugas</h1>

                <div class="flex space-x-3">
                    <Link :href="route('task.edit', task.id)"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Edit
                    </Link>

                    <button @click="deleteTask" :disabled="formDelete.processing"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Hapus
                    </button>

                    <Link :href="route('task.index')"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    ← Kembali
                    </Link>
                </div>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100 space-y-8">

                <div>
                    <h2 class="text-4xl font-extrabold text-gray-900 leading-tight"
                        :class="{ 'line-through text-gray-500': task.is_completed }">
                        {{ task.task_name }}
                    </h2>
                    <p class="mt-2 text-sm text-gray-500">Created at {{ formatDate(task.created_at) }}</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 border-t pt-6">

                    <div>
                        <p class="text-sm font-medium text-gray-500">Status</p>
                        <span
                            :class="['mt-1 px-3 py-1 inline-flex text-sm font-semibold rounded-full', getStatusBadgeClasses(task.is_completed)]">
                            {{ task.is_completed ? '✅ Selesai' : '⏳ Tertunda' }}
                        </span>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Prioritas</p>
                        <span
                            :class="['mt-1 px-3 py-1 inline-flex text-sm font-semibold rounded-full', getPriorityBadgeClasses(task.priority)]">
                            {{ task.priority.charAt(0).toUpperCase() + task.priority.slice(1) }}
                        </span>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Dateline</p>
                        <p class="text-base text-gray-800 mt-1">
                            {{ task.dateline ? formatDate(task.dateline) : 'Tidak Ditetapkan' }}
                        </p>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Deskripsi</h3>
                    <div class="prose max-w-none text-gray-700 p-4 bg-gray-50 rounded-lg">
                        <p v-if="task.description">
                            {{ task.description }}
                        </p>
                        <p v-else class="text-gray-400 italic">
                            Tidak ada deskripsi yang disediakan.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>