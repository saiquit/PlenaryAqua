<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            "name_en" => $name,
            "name_bn" => "বাংলা" . $name,
            "slug" => Str::slug($name),
            "desc_en" => $this->faker->sentences(4, true),
            "desc_bn" => "বাংলা" . $this->faker->sentences(4, true)
        ];
    }
}
