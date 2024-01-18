<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Program;

class ProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Program::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'image' => $this->faker->word(),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'student_count' => $this->faker->word(),
            'is_published' => $this->faker->boolean(),
            'fields' => '{}',
            'interview_min_rate' => $this->faker->word(),
        ];
    }
}
