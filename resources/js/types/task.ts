import type { Ref } from 'vue';

export interface Task {
    id: number;
    title: string;
    description: string;
    category_id: number;
}

export interface TaskStore {
    tasks: Ref<Task[]>;
    loading: Ref<boolean>;
    setTasks: (data: Task[]) => void;
    fetchTasks: () => Promise<void>;
}

export interface TaskForm {
  title: string;
  description: string;
  category_id: string;
}

export interface TaskErrors {
  title?: string;
  description?: string;
  category_id?: string;
}

export interface Category {
  id: number;
  name: string;
  parent_id: number | null;
  children?: Category[];
}
