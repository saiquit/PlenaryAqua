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
        // \App\Models\User::factory([
        //     'email' => 'customer@plenaryaqua.com',
        //     'password' => bcrypt('password'),
        // ])->create();
        \App\Models\User::factory([
            'email' => 'support@plenaryaqua.com',
            'type'  => 'admin',
            'password' => bcrypt('support@@aquaplenary'),
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


        \App\Models\Category::factory()->create([
            'name_en' => 'River Fish',
            'name_bn' => 'নদীর মাছ',
        ]);
        \App\Models\Category::factory()->create([
            'name_en' => 'Beel Fish',
            'name_bn' => 'বিল মাছ',
        ]);
        \App\Models\Category::factory()->create([
            'name_en' => 'Sea Fish',
            'name_bn' => 'সামুদ্রিক মাছ',
        ]);
        \App\Models\Category::factory()->create([
            'name_en' => 'Farmed Fish',
            'name_bn' => 'ঘের মাছ',
        ]);
        \App\Models\Category::factory()->create([
            'name_en' => 'Dried Fish',
            'name_bn' => 'অর্গানিক শুটকি মাছ',
        ]);
        \App\Models\Category::factory()->create([
            'name_en' => 'Meat',
            'name_bn' => 'মাংস/গোসত',
        ]);
        \App\Models\Category::factory()->create([
            'name_en' => 'Student\'s specials',
            'name_bn' => 'ছোট প্যাক',
        ]);
        \App\Models\Category::factory()->create([
            'name_en' => 'Steaks and Fillets',
            'name_bn' => 'স্টেক এবং ফিলেট',
        ]);
        \App\Models\Category::factory()->create([
            'name_en' => 'Others',
            'name_bn' => 'অন্যান্য',
        ]);

        // $categories = \App\Models\Category::each(function ($c) {
        //     $c->products()->saveMany(\App\Models\Product::factory(20)->make())->each(function ($p) {
        //         $p->variations()->saveMany(\App\Models\Variation::factory(rand(1, 5))->make())->each(function ($v) {
        //             $random_number_array = range(1, 3);
        //             shuffle($random_number_array);
        //             $random_number_array = array_slice($random_number_array, 0, rand(1, 2));
        //             $v->tags()->attach($random_number_array);
        //         });
        //     });
        //     $c->blogs()->saveMany(\App\Models\Blog::factory(2)->make());
        // });
        // \App\Models\Blog::factory(20)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


    }
}
