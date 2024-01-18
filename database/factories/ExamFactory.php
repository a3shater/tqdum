<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Exam;
use App\Models\Program;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exam::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'min_degree' => $this->faker->word(),
            'exam_date' => $this->faker->dateTime(),
            'program_id' => Program::factory(),
        ];
    }
}
