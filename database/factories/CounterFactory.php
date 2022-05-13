<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Counter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CounterFactory extends Factory
{
    protected $model = Counter::class;

    public function definition(): array
    {
        return [
            'vri_id' => $this->faker->word(),
            'registration_type_number' => $this->faker->word(),
            'modification_name' => $this->faker->name(),
            'factory_number' => $this->faker->word(),
            'release_year' => $this->faker->randomNumber(),
            'verification_date' => Carbon::now(),
            'valid_until' => Carbon::now(),
            'is_valid' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'address_id' => Address::factory(),
        ];
    }
}
