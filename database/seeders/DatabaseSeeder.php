<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Post::factory(10)->create();

        // User::create([
        //     'name' => 'Perry Saputra',
        //     'username' => 'perry1611',
        //     'email' => 'perrysiregar0@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        // Category::create([
        //     'name' => 'Primary',
        //     'image' => 'category1.jpg',
        //     'description' => 'Primary cost like food and supplies for daily life',
        // ]);
        // Category::create([
        //     'name' => 'Bill',
        //     'image' => 'category2.jpg',
        //     'description' => 'Bill cost like electricity, water, internet, insurance, etc',
        // ]);
        // Category::create([
        //     'name' => 'Miscellaneous',
        //     'image' => 'category3.jpg',
        //     'description' => 'Miscellaneous cost like accessories, entertainment, etc',
        // ]);

        // Post::create([
        //     'title' => 'Buying iphone x from dark web',
        //     'body' => 'you will not believe this, but i bought iphone x from dark web that i can spill the name, lets unboxing it first',
        //     'cost' => 15000000,
        //     'user_id' => 1,
        //     'category_id' => 1,
        // ]);
        // Post::create([
        //     'title' => 'Buying random stuff',
        //     'body' => 'Buying random stuff from shopee, lets hope the best for this',
        //     'cost' => 1000000,
        //     'user_id' => 1,
        //     'category_id' => 3,
        // ]);
    }
}
