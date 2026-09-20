<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Slider>
 */
class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => '/uploads/test',
            'offer' => '50%',
            'title' => fake()->sentence(),
            'sub_title' => fake()->sentence(10),
            'short_description' => fake()->paragraph(2),
            'button_link' => fake()->url(),
            'status' => fake()->boolean()
        ];
    }
}
