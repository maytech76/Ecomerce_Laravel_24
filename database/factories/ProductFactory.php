<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Insertamos los campos, tipos y parametros necesarios
            'sku' => $this->faker->unique()->numberBetween(10000, 99999),
            'name' => $this->faker->sentence(),
            'description'=> $this->faker->text(200),
            'images_path'=>'products/'.$this->faker->image('public/storage/products', 640, 480, null, false),
            'price'=>$this->faker->randomFloat(2, 1, 1000),
            'subcategory_id' =>$this->faker->numberBetween(1,92)
        ];
    }
}
