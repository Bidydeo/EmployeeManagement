<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id'=> $this->faker->randomElement(Company::pluck('id')->toArray()),
            'department_id'=> $this->faker->randomElement(Department::pluck('id')->toArray()),
            'employee_name'=> $this->faker->name,
            'employee_lastname'=> $this->faker->lastName,
            'status'=> $this->faker->randomElement(['active', 'inactive']),
            'email'=> $this->faker->unique()->safeEmail,
        ];
    }
}
