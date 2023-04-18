<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DeliverySeeder::class
        ]);
        \App\Models\User::factory(1)->create();
        \App\Models\User::factory([
            'email' => 'admin@admin.com'
        ])->create();
        \App\Models\District::factory()->create([
            'name_en' => 'Dhaka',
            'name_bn' => 'ঢাকা',
            'slug'    => 'dhaka'
        ]);
        \App\Models\District::factory()->create([
            'name_en' => 'Khulna',
            'name_bn' => 'খুলনা',
            'slug'    => 'khulna'
        ]);

        \App\Models\Tag::factory()->create([
            'name_en' => 'Top Rated',
            'name_bn' => 'টপ রেটেড',
            'slug'    => 'top-rated'
        ]);

        \App\Models\Tag::factory()->create([
            'name_en' => 'Featured',
            'name_bn' => 'ফিচারড',
            'slug'    => 'featured'
        ]);
        \App\Models\Tag::factory()->create([
            'name_en' => 'Deal of the day',
            'name_bn' => 'ডিল অফ দি ডে',
            'slug'    => 'deal-of-the-day'
        ]);


        $categories = \App\Models\Category::factory(10)->create()->each(function ($c) {
            $c->products()->saveMany(\App\Models\Product::factory(20)->make())->each(function ($p) {
                $p->variations()->saveMany(\App\Models\Variation::factory(rand(1, 5))->make())->each(function ($v) {
                    $v->districts()->attach(rand(1, 2), [
                        'stock' => random_int(0, 10),
                        'price' => floatval(random_int(10, 100)),
                        'discounted_from_price' => floatval(random_int(10, 100)),
                        'discount' => floatval(random_int(10, 100)),
                    ]);
                    $random_number_array = range(1, 3);
                    shuffle($random_number_array);
                    $random_number_array = array_slice($random_number_array, 0, rand(1, 2));

                    $v->tags()->attach($random_number_array);
                });
            });
        });

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
