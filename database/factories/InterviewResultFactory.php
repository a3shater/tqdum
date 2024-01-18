<?php

namespace Database\Factories;

use App\Models\Interview;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\InterviewResult;
use App\Models\Interviewer;

class InterviewResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InterviewResult::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'note' => $this->faker->word(),
            'interviewer_id' => Interviewer::factory(),
            'interview_id' => Interview::factory(),
        ];
    }
}
