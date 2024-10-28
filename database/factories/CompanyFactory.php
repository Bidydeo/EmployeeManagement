<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Company::class;
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name,
            'address'=>$this->faker->address,
            'city'=>$this->faker->name,
            'email'=>$this->faker->unique()->safeEmail,
            'website'=>$this->faker->name,
            'iban'=>$this->faker->randomNumber,
            'bank'=>$this->faker->name,
            'bank_address'=>$this->faker->address,
            'bank_city'=>$this->faker->name,
            'bank_swift'=>$this->faker->randomNumber,
            'billing_name'=>$this->faker->name,
            'billing_address'=>$this->faker->address,
            'billing_j'=>$this->faker->randomNumber,
            'billing_cui'=>$this->faker->randomNumber,
            'phone'=>$this->faker->phoneNumber,
            'admin_name'=>$this->faker->name,
            'admin_title'=>$this->faker->name
        ];
    }
}
