<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';


const props = defineProps({
  // Menerima objek Paginator dari Controller (Nama Prop: data)
  'data': Object
});


// Helper untuk Status (Completed/Pending)
const getStatusBadgeClasses = (isCompleted) => {
  return isCompleted
    ? 'bg-green-100 text-green-800'
    : 'bg-yellow-100 text-yellow-800';
};

// Helper untuk Priority (Opsional, bisa dilakukan inline)
const getPriorityBadgeClasses = (priority) => {
  const map = {
    'low': 'bg-green-100 text-green-800',
    'medium': 'bg-blue-100 text-blue-800',
    'high': 'bg-red-100 text-red-800',
  };
  return map[priority] || 'bg-gray-100 text-gray-800';
};
</script>

<template>
  <AuthenticatedLayout title="Dashboard">

    <Head title="Dashboard" />

    <div class="py-8 px-6 lg:px-8 bg-gray-50 min-h-screen">
      <div class="flex justify-between">
        <div class="">
          <h1 class="text-3xl font-bold text-gray-900 mb-6">Tasks</h1>
        </div>
        <div class="">
          <Link :href="route('task.create')"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-gray-300 rounded-md font-semibold text-xs text-gray-200 uppercase tracking-widest shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
          Add New
          </Link>
        </div>
      </div>

      <div class="grid grid-cols-1 gap-6">
        <div class="lg:col-span-2">

          <div class="bg-white rounded-xl shadow-lg p-6 ">
            <h3 class="text-lg font-semibold text-gray-800">All Tasks</h3>
            <span class="text-gray-500 text-xs mb-4">click on the task name to view details</span>

            <div class="overflow-x-auto mt-4 mb-6 min-h-[320px]">
              <table class="min-w-full divide-y divide-gray-200 w-full">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task Name
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dateline
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="task in props.data.data" :key="task.id">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      <Link :href="route('task.show', task.id)" class="hover:text-indigo-600 font-medium">{{ task.title
                        || task.task_name }}</Link>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                      <span
                        :class="['px-2 inline-flex text-xs leading-5 font-semibold rounded-full', getPriorityBadgeClasses(task.priority)]">
                        {{ task.priority.charAt(0).toUpperCase() + task.priority.slice(1) }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                      <span
                        :class="['mt-1 px-3 py-1 inline-flex text-sm font-semibold rounded-full', getStatusBadgeClasses(task.is_completed)]">
                        {{ task.is_completed ? '✅ done' : '⏳ pending' }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ task.dateline }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div v-if="props.data.last_page > 1" class="flex justify-center mb-1 space-x-2">

              <template v-for="(link, index) in props.data.links" :key="index">

                <div v-if="!link.url" v-html="link.label"
                  class="px-3 py-2 text-sm text-gray-400 border rounded-lg cursor-not-allowed">
                </div>

                <Link v-else :href="link.url" v-html="link.label"
                  class="px-3 py-2 text-sm border rounded-lg transition duration-150" :class="{
                    'bg-indigo-600 text-white border-indigo-600 font-bold': link.active,
                    'text-gray-700 hover:bg-gray-100': !link.active
                  }">
                </Link>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>