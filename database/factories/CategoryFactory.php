<?php

namespace Database\Factories;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory {
    
    protected $model = Category::class;
    public function definition(): array
    {
      
            return [
                'name' => $this->faker->word,
                'slug' => Str::slug($this->faker->word),
                'image' => $this->faker->imageUrl(),
            ];
       
    }
}
