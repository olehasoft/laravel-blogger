<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => Str::ucfirst($this->faker->words(rand(5, 10), true)),
            'content' => "<p>" . implode("</p>\n<p>", $this->faker->paragraphs(5)) . "</p>\n",
        ];
    }
}
