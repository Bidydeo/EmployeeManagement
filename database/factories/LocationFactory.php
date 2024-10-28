<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id'=>$this->faker->randomElement(Company::pluck('id')->toArray()),
            'name'=>$this->faker->name,
            'latitude'=>$this->faker->latitude,
            'longitude'=>$this->faker->longitude,
            'radius'=>$this->faker->numberBetween(0,600),
        ];
    }
}
