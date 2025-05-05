<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dev = Category::create(['name' => 'Development']);

        $frontend = Category::create(['name' => 'Frontend', 'parent_id' => $dev->id]);
        $backend  = Category::create(['name' => 'Backend', 'parent_id' => $dev->id]);

        $frontend->tasks()->createMany([
            ['title' => 'Design UI', 'description' => 'Design the components using Tailwind CSS'],
            ['title' => 'Integrate Inertia', 'description' => 'Synchronize the frontend with Laravel via Inertia.js'],
        ]);

        $backend->tasks()->createMany([
            ['title' => 'Build task API', 'description' => 'Create RESTful endpoints for tasks'],
            ['title' => 'Add form validation', 'description' => 'Use FormRequest to validate task inputs'],
        ]);
    }
}
