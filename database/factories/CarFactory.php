<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;

class CarFactory extends Factory {
    protected $model = Car::class;

    public function definition(): array {
        return [
            'make' => fake()->company(),
            'model' => fake()->bothify('?????-#####'),
            'produced_on' => fake()->date(),
        ];
    }
}
