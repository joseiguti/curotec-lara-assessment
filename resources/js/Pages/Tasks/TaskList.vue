<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Task List</h1>
    <div v-if="taskStore.loading">Loading tasks...</div>
    <ul v-else class="space-y-2">
      <li v-for="task in taskStore.tasks" :key="task.id" class="border p-4 rounded">
        <h2 class="text-lg font-semibold">{{ task.title }}</h2>
        <p class="text-sm text-gray-600">{{ task.description }}</p>
        <p>Category: {{ task.category?.name ?? 'Uncategorized' }}</p>
        <div class="mt-2 space-x-2">
          <button @click="deleteTask(task.id)" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Delete</button>
          <button @click="editTask(task)" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</button>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { useTaskStore } from '@/stores/taskStore';
import { useTaskForm } from '@/composables/useTaskForm';

const taskStore = useTaskStore();
const { deleteTask, editTask } = useTaskForm(taskStore);
</script>
