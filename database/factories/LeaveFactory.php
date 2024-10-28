<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'employee_id'=>$this->faker->randomElement(Employee::pluck('id')->toArray()),
        'leave_type_id'=>$this->faker->randomElement(LeaveType::pluck('id')->toArray()),
        'start_date'=>$this->faker->dateTime(),
        'end_date'=>$this->faker->dateTime(),
        'substitute_employee_id'=>$this->faker->randomElement(Employee::pluck('id')->toArray()),
        'substituteApproved'=>false,
        'substitute_action_date'=>$this->faker->dateTime(),
        'manager_id'=>$this->faker->randomElement(Department::pluck('manager_id')->toArray()), // Alege random din managerii existenți
        'managerApproved'=>false,
        'manager_action_date'=>$this->faker->dateTime(),
        'status'=>$this->faker->randomElement(['Pending', 'ApprovedBySubstitute','RejectedBySubstitute','Approved', 'Rejected']),
        'reason'=>$this->faker->text(200),
        'comments'=>$this->faker->text(30),
        ];
    }
}
