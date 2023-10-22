<?php

namespace Database\Factories;

use App\Models\Post;
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
    protected $model = Post::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(2, true),
            'slug' => Str::slug($this->faker->words(2, true)),
            'body' => $this->faker->paragraphs(3, true),
            'version'=>$this->faker->numberBetween(1, 2),
            'user_id'=> $this->faker->numberBetween(1, 5),
            'category_id'=> $this->faker->numberBetween(1, 5),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
