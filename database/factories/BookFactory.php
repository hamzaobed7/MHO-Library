<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ISBN' => $this->faker->unique()->isbn13(),
             'category_id' => $this->faker->numberBetween(1, 3),
             'name'=>$this->faker->sentence(3),
             'price'=>$this->faker->randomFloat(2, 10, 100),
              'publication_date'=>$this->faker->date(),
                'quantity'=>$this->faker->numberBetween(1, 50),
                'available_quantity'=>$this->faker->numberBetween(1, 50),
                'authors' => $this->faker->randomElements(range(1, 4), 3),


        ];
    }
}
