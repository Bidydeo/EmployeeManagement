<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Project;
use App\Models\Location;
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
    protected $model = Location::class;
    
    public function definition(): array
    {
        // Alegem o companie aleatorie
    $company = Company::inRandomOrder()->first();

    // Alegem un proiect care aparține acelei companii
    $project = Project::where('company_id', $company->id)->inRandomOrder()->first();
        return [
            'company_id'=>$this->faker->randomElement(Company::pluck('id')->toArray()),
            'project_id' => $project ? $project->id : null, // null dacă nu există proiecte (evită eroare)
            'name'=>$this->faker->name,
            'latitude'=>$this->faker->latitude,
            'longitude'=>$this->faker->longitude,
            'radius'=>$this->faker->numberBetween(0,600),
        ];
    }
}
