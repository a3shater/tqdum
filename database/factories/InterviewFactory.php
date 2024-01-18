<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Application;
use App\Models\Interview;
use App\Models\Program;

class InterviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Interview::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'program_id' => Program::factory(),
            'application_id' => Application::factory(),
            'interview_date' => $this->faker->dateTime(),
        ];
    }
}
