<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            "Web Development",
            "PHP Tutorials",
            "Laravel Tips",
            "WordPress Themes",
            "SEO Strategies",
            "Design Inspiration",
            "Coding Challenges",
            "Developer News",
            "Freelancing Tips",
            "Career Advice"
        ];
        $category = fake()->unique()->randomElement($categories);
        return [
            'name' => $category,
            'slug' => str($category)->slug(),
        ];
    }
}
