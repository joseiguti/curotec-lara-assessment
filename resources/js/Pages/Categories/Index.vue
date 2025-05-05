<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Categories & Tasks</h1>
        <div v-for="category in categories" :key="category.id" class="mb-6">
            <h2 class="text-xl font-semibold">{{ category.name }}</h2>

            <div v-if="category.tasks.length" class="pl-4">
                <h3 class="font-medium">Tasks:</h3>
                <ul class="list-disc ml-4">
                    <li v-for="task in category.tasks" :key="task.id">
                        {{ task.title }} - {{ task.description }}
                    </li>
                </ul>
            </div>

            <div v-if="category.children.length" class="pl-4 mt-2">
                <h3 class="font-medium">Subcategories:</h3>
                <ul class="list-disc ml-4">
                    <li v-for="sub in category.children" :key="sub.id">{{ sub.name }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    categories: Array
})
</script>
