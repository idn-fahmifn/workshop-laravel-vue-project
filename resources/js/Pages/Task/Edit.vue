<script setup>
// Mengimpor komponen bawaan
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

// Menerima props 'task' dari TaskController@edit
const props = defineProps({
  task: {
    type: Object,
    required: true,
  },
});

// Form Inertia untuk update tugas (UPDATE)
const form = useForm({
  // Mengisi form dengan data yang diterima dari props task
  task_name: props.task.task_name,
  priority: props.task.priority,
  dateline: props.task.dateline, // Format YYYY-MM-DD dari Controller
  description: props.task.description,
  is_completed: props.task.is_completed, // Status Completion
});

const priorityOptions = [
  { value: 'low', label: 'Low' },
  { value: 'medium', label: 'Medium' },
  { value: 'high', label: 'High' },
];

const submitUpdate = () => {
  // Logic PUT/PATCH ke route tasks.update/ID
  form.put(route('task.update', props.task.id), {
    preserveScroll: true,
    onSuccess: () => {
      // Opsional: tampilkan notifikasi sukses
    }
  });
};
</script>

<template>
  <AuthenticatedLayout title="Task">

    <Head :task_name="`Edit Task: ${task.task_name}`" />

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Task: {{ task.task_name }}</h1>

        <Link :href="route('task.index')"
          class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 uppercase tracking-wider hover:text-gray-900 transition ease-in-out duration-150">
        ← CLOSE
        </Link>
      </div>

      <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">

        <form @submit.prevent="submitUpdate" class="space-y-6">

          <div>
            <InputLabel for="task_name" value="Task Name" />
            <TextInput id="task_name" type="text" class="mt-1 block w-full" v-model="form.task_name" required autofocus />
            <InputError class="mt-2" :message="form.errors.task_name" />
          </div>

          <div class="grid grid-cols-2 gap-6">
            <div class="col-span-1">
              <InputLabel for="priority" value="Priority" />
              <select id="priority" v-model="form.priority" required
                class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm">
                <option v-for="option in priorityOptions" :key="option.value" :value="option.value">
                  {{ option.label }}
                </option>
              </select>
              <InputError class="mt-2" :message="form.errors.priority" />
            </div>

            <div class="col-span-1">
              <InputLabel for="dateline" value="Dateline" />
              <input id="dateline" type="date"
                class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                v-model="form.dateline" />
              <InputError class="mt-2" :message="form.errors.dateline" />
            </div>
          </div>


          <div>
            <InputLabel for="description" value="Description" />
            <textarea id="description"
              class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
              v-model="form.description" rows="4"></textarea>
            <InputError class="mt-2" :message="form.errors.description" />
          </div>

          <div class="flex items-center pt-4">
            <input type="checkbox" id="is_completed" v-model="form.is_completed"
              class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
            <label for="is_completed" class="ml-2 text-base text-gray-700 font-medium">
              Completed?
            </label>
            <InputError class="mt-2" :message="form.errors.is_completed" />
          </div>

          <div class="flex justify-end pt-4">
            <PrimaryButton type="submit" class="bg-indigo-600 hover:bg-indigo-700 disabled:bg-gray-400"
              :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
              SAVE CHANGES
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>