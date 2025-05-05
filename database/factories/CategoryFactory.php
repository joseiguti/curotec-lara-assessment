<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory for creating Category model instances.
 *
 * Fields:
 * - name: A random word used as the category name.
 * - parent_id: Null by default, can be set to link subcategories.
 */
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'parent_id' => null,
        ];
    }
}
