<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variation>
 */
class VariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->randomFloat(2, 2, 5);
        return [
            "name_en" => $name . 'K.G.',
            "name_bn" => $name .  'K.G.',
            "slug" => Str::slug($name),
            'district_id' => fake()->randomElement(['1', '2']),
            "desc_en" => $this->faker->sentences(4, true),
            "desc_bn" => "বাংলা" . $this->faker->sentences(4, true),
            "weight" => str($name),
            "gross_weight" => str($name),
            'stock' => random_int(0, 10),
            'price' => floatval(random_int(10, 100)),
            'discounted_from_price' => floatval(random_int(10, 100)),
            'discount' => floatval(random_int(10, 100)),
        ];
    }
}
