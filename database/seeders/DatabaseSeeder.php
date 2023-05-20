<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            DeliverySeeder::class,
            AdditionalPageSeeder::class
        ]);
        \App\Models\User::factory(1)->create();
        \App\Models\User::factory([
            'email' => 'admin@admin.com',
            'type'  => 'admin'
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
                    $random_number_array = range(1, 3);
                    shuffle($random_number_array);
                    $random_number_array = array_slice($random_number_array, 0, rand(1, 2));
                    $v->tags()->attach($random_number_array);
                });
            });
            $c->blogs()->saveMany(\App\Models\Blog::factory(2)->make());
        });
        // \App\Models\Blog::factory(20)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


    }
}
