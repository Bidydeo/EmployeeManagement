<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Project::class;
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name,
            'slug'=>$this->faker->slug,
            'client_id'=>$this->faker->randomElement(Client::pluck('id')->toArray()),
            'company_id'=>$this->faker->randomElement(Company::pluck('id')->toArray()),
            'status'=>$this->faker->randomElement(['Not Started', 'On Hold', 'Canceled', 'In Progress', 'Completed']),
        ];
    }
}
