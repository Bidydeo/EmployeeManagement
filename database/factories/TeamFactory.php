<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Team::class;
    public function definition(): array
    {
        $project = Project::with('company')->inRandomOrder()->first();

        return [
            'name' => $this->faker->company . ' Team',
            'project_id' => $project->id,
            'company_id' => $project->company_id,
        ];
    }
}
