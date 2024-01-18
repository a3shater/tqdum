<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Application;
use App\Models\Exam;
use App\Models\ExamResult;

class ExamResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExamResult::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'exam_degree' => $this->faker->word(),
            'note' => $this->faker->word(),
            'exam_id' => Exam::factory(),
            'application_id' => Application::factory(),
        ];
    }
}
