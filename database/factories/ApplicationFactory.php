<?php

namespace Database\Factories;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Application;
use App\Models\Program;
use App\Models\Status;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'program_id' => Program::factory(),
            'applicant_id' => Applicant::factory(),
            'values' => '{}',
            'status_id' => Status::factory(),
        ];
    }
}
