<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Task;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_tasks_api_returns_successful_response(): void
    {
        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'tasks'
                 ]);
    }
    /**
     * Test that a task can be created successfully via the API.
     */
    public function test_create_task(): void
    {
        $category = Category::factory()->create();

        $response = $this->postJson('/api/tasks', [
            'title' => 'New Task',
            'description' => 'This is a new task',
            'category_id' => $category->id,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'description' => 'This is a new task',
            'category_id' => $category->id,
        ]);
    }

    /**
     * Test that a task can be updated successfully via the API.
     */
    public function test_update_task(): void
    {
        $task = Task::factory()->create();

        $payload = [
            'title' => 'Updated Task',
            'description' => 'Updated description',
            'category_id' => $task->category_id,
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $payload);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Updated Task']);
    }

    /**
     * Test that a task can be deleted successfully via the API.
     */
    public function test_delete_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(204);
    }

    /**
     * Test validation errors are returned when creating a task with missing fields.
     */
    public function test_create_task_validation_fails(): void
    {
        $payload = []; // empty payload

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['title', 'description', 'category_id']);
    }

    /**
     * Test the relationship that a task belongs to a category.
     */
    public function test_task_belongs_to_category(): void
    {
        $category = Category::factory()->create();
        $task = Task::factory()->create([
            'category_id' => $category->id,
        ]);

        $this->assertEquals($category->id, $task->category->id);
    }

    /**
     * Test that a category can have tasks.
     */
    public function test_category_has_tasks(): void
    {
        $category = Category::factory()->create();
        $task = Task::factory()->create(['category_id' => $category->id]);

        $this->assertTrue($category->tasks->contains($task));
    }

    /**
     * Test that a category without tasks returns an empty relationship.
     */
    public function test_category_without_tasks(): void
    {
        $category = Category::factory()->create();

        $this->assertCount(0, $category->tasks);
    }

    /**
     * Test that a category can have subcategories.
     */
    public function test_category_with_subcategories(): void
    {
        $parent = Category::factory()->create();
        $child = Category::factory()->create(['parent_id' => $parent->id]);

        $this->assertTrue($parent->children->contains($child));
    }

    /**
     * Test that the categories API returns a successful response with the correct structure.
     */
    public function test_categories_api_returns_successful_response(): void
    {
        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'categories'
                 ]);
    }

}
