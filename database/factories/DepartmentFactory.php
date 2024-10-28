<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
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
            'name'=> $this->faker->randomElement
            (['IT', 'HR', 'Sales', 'Marketing', 'Finance']), // Lista de unde alege aleatoriu
        ];
    }
}
