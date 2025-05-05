<script setup>
import TaskForm from './TaskForm.vue';
import TaskList from './TaskList.vue';

import { onMounted } from 'vue';
import { useTaskStore } from '@/stores/taskStore';

const taskStore = useTaskStore();


onMounted(() => {
  taskStore.fetchTasks();
});
</script>

<template>
  <div class="p-6">
    <TaskForm />
    <TaskList />
  </div>
</template>

<style scoped>

</style>
