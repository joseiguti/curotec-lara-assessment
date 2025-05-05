<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $development = Category::create(['name' => 'Development']);

        $frontend = Category::create([
            'name' => 'Frontend',
            'parent_id' => $development->id,
        ]);

        $backend = Category::create([
            'name' => 'Backend',
            'parent_id' => $development->id,
        ]);

        $frontend->tasks()->createMany([
            [
                'title' => 'Design UI',
                'description' => 'Design the components using Tailwind CSS',
            ],
            [
                'title' => 'Integrate Inertia',
                'description' => 'Synchronize the frontend with Laravel via Inertia.js',
            ],
        ]);

        $backend->tasks()->createMany([
            [
                'title' => 'Build task API',
                'description' => 'Create RESTful endpoints for tasks',
            ],
            [
                'title' => 'Add form validation',
                'description' => 'Use FormRequest to validate task inputs',
            ],
        ]);

        User::create([
            'name' => 'Jose Gutierrez',
            'email' => 'me@joseiguti.com',
            'password' => bcrypt('aneasywaytolivebetter'),
        ]);
    }
}
