<template>
  <form @submit.prevent="submitTask" class="mb-6 space-y-2">
    <input v-model="newTask.title" type="text" placeholder="Title" class="w-full border p-2 rounded" required />
    <p v-if="errors.title" class="text-red-500 text-sm">{{ errors.title }}</p>
    <textarea v-model="newTask.description" placeholder="Description" class="w-full border p-2 rounded" required></textarea>
    <p v-if="errors.description" class="text-red-500 text-sm">{{ errors.description }}</p>
    <select v-model="newTask.category_id" class="w-full border p-2 rounded">
      <option value="">Select a category</option>
      <optgroup v-for="cat in categories" :key="cat.id" :label="cat.name">
        <option v-for="child in cat.children" :key="child.id" :value="child.id">
          {{ child.name }}
        </option>
      </optgroup>
    </select>
    <p v-if="errors.category_id" class="text-red-500 text-sm">{{ errors.category_id }}</p>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
      {{ editingTaskId ? 'Update Task' : 'Add Task' }}
    </button>
    <button v-if="editingTaskId" type="button" @click="cancelEdit" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">
      Cancel
    </button>
  </form>
</template>

<script setup>
import { useTaskStore } from '@/stores/taskStore';
import { useTaskForm } from '@/composables/useTaskForm';

const taskStore = useTaskStore();
const {
  newTask,
  errors,
  categories,
  editingTaskId,
  fetchCategories,
  submitTask,
  cancelEdit,
} = useTaskForm(taskStore);

fetchCategories();
</script>
