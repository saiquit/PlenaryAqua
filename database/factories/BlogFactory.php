<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->words(3, true);
        return [
            "title" => $name,
            "slug" => Str::slug($name),
            "content" => $this->faker->sentences(30, true),
            "short_desc" => $this->faker->sentences(10, true),
            "author_name" => $this->faker->name,

        ];
    }
}
