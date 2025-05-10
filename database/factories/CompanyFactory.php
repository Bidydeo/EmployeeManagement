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
            'company_name'=>$this->faker->name,
            'company_town'=>$this->faker->city,
            'company_email'=>$this->faker->unique()->safeEmail,
            'website'=>$this->faker->name,
            'iban'=>$this->faker->randomNumber,
            'bank'=>$this->faker->name,
            'bank_address'=>$this->faker->address,
            'bank_city'=>$this->faker->city,
            'bank_swift'=>$this->faker->randomNumber,
            'company_reg_com'=>$this->faker->randomNumber,
            'company_cui'=>$this->faker->randomNumber,
            'company_phone'=>$this->faker->phoneNumber,
            'company_admin'=>$this->faker->name,
            'company_logo'=>$this->faker->image,
            'company_country' =>$this->faker->country,
            'company_district'=>$this->faker->randomNumber,
            'company_street_name'=>$this->faker->name,
            'company_street_no'=>$this->faker->randomNumber,
            'domeniu_email'=>$this->faker->name
        ];
    }
}

            
