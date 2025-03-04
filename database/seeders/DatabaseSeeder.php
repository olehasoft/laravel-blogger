<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * Creating test user.
         */
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        /**
         * Creating categories.
         */
        $categories = Category::factory(5)->create();

        /**
         * Creating posts with a random category.
         */
        $posts = Post::factory(20)->state(fn () => [
            'category_id' => $categories->random(),
        ])->create();

        /**
         * Creating a random number of comments for each post.
         */
        $posts->each(function (Post $post) {
            Comment::factory(rand(0, 3))->for($post)->create();
        });
    }
}
