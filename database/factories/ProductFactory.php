<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(3, true);
        $price = fake()->randomFloat(2, 5, 100);
        $offerPrice = fake()->boolean(30) ? fake()->randomFloat(2, 1, $price - 1) : 0;

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'main_image' => '/uploads/test.jpg',
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory()->create()->id,
            'short_description' => fake()->sentence(15),
            'long_description' => fake()->paragraph(5),
            'price' => $price,
            'offer_price' => $offerPrice,
            'sku' => strtoupper(fake()->bothify('PRD-####-???')),
            'seo_title' => fake()->sentence(6),
            'seo_description' => fake()->sentence(20),
            'show_at_home' => fake()->boolean(70),
            'status' => fake()->boolean(90),
        ];
    }
}
