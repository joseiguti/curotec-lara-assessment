import { ref } from 'vue';
import axios from 'axios';
import type { Task, TaskStore, TaskForm, TaskErrors } from '../types/task';
import type { Category } from '../types/task';

export function useTaskForm(taskStore: TaskStore) {
  const newTask = ref<TaskForm>({
    title: '',
    description: '',
    category_id: ''
  });

  const errors = ref<TaskErrors>({});
  const categories = ref<Category[]>([]);
  const editingTaskId = ref<number | null>(null);

  async function fetchCategories() {
    try {
      const response = await axios.get('/api/categories');
      categories.value = response.data.categories;
    } catch (error) {
      console.error('Error loading categories:', error);
    }
  }

  async function submitTask() {
    errors.value = {};

    if (!newTask.value.title) errors.value.title = 'Title is required.';
    if (!newTask.value.description) errors.value.description = 'Description is required.';
    if (!newTask.value.category_id) errors.value.category_id = 'Please select a category.';

    if (Object.keys(errors.value).length > 0) {
      return;
    }

    try {
      if (editingTaskId.value) {
        await axios.put(`/api/tasks/${editingTaskId.value}`, newTask.value);
      } else {
        await axios.post('/api/tasks', newTask.value);
      }

      newTask.value = { title: '', description: '', category_id: '' };
      editingTaskId.value = null;
      errors.value = {};
      await taskStore.fetchTasks();
    } catch (error: unknown) {
      if (axios.isAxiosError(error) && error.response?.status === 422) {
        errors.value = error.response.data.errors;
      } else {
        console.error('Failed to save task:', error);
      }
    }
  }

  async function deleteTask(id: number): Promise<void> {
    if (!confirm('Are you sure you want to delete this task?')) return;

    try {
      await axios.delete(`/api/tasks/${id}`);
      await taskStore.fetchTasks();
    } catch (error) {
      console.error('Failed to delete task:', error);
    }
  }

  function editTask(task: Task): void {
    editingTaskId.value = task.id;
    newTask.value.title = task.title;
    newTask.value.description = task.description;
    newTask.value.category_id = String(task.category_id);
  }

  function cancelEdit() {
    editingTaskId.value = null;
    newTask.value = { title: '', description: '', category_id: '' };
    errors.value = {};
  }

  return {
    newTask,
    errors,
    categories,
    editingTaskId,
    fetchCategories,
    submitTask,
    deleteTask,
    editTask,
    cancelEdit
  };
}
