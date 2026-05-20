<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'text' => fake()->paragraph(),
            'image' => fake()->optional(0.8)->passthrough(
                UploadedFile::fake()->image('article.jpg', 640, 480)->store('articles', 'public')
            ),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
