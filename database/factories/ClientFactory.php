<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Client::class;
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name,
            'country'=>$this->faker->country,
            'email'=> $this->faker->unique()->safeEmail,
            // 'company_id'=>$this->faker->randomElement(Company::pluck('id')->toArray()),
        ];
    }
}
