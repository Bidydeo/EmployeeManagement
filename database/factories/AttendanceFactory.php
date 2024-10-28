<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
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
            'location_id'=>$this->faker->randomElement(Location::pluck('id')->toArray()),
            'date'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'clock_in_time'=>$this->faker->time($format = 'H:i:s', $max = 'now'),
            'clock_out_time'=>$this->faker->time($format = 'H:i:s', $max = 'now'),
            'latitude_in'=>$this->faker->latitude(),
            'longitude_in'=>$this->faker->longitude(),
            'latitude_out'=>$this->faker->latitude(),
            'longitude_out'=>$this->faker->longitude(),
        ];
    }
}
