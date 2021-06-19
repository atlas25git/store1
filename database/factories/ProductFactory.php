<?php

namespace Database\Factories;

use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

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
     * @return array
     */
    public function definition()
    {
        return [
        'name' => $this->faker->sentence(2),
        'description' => $this->faker->sentence(20),
        'price' => $this->faker->numberBetween(100, 5000),

        ];
    }
}
