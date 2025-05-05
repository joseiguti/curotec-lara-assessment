import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useTaskStore = defineStore('task', () => {
    const tasks = ref([]);
    const loading = ref(false);

    function setTasks(data) {
        tasks.value = data;
    }

    async function fetchTasks() {
        loading.value = true;
        try {
            const response = await axios.get('/api/tasks', { withCredentials: true });
            tasks.value = response.data.tasks;
        } catch (error) {
            console.error(error);
        } finally {
            loading.value = false;
        }
    }

    return {
        tasks,
        loading,
        setTasks,
        fetchTasks,
    };
});
