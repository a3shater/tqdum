<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Criteria;
use App\Models\InterviewResult;
use App\Models\Result;

class ResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Result::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'result' => $this->faker->word(),
            'criteria_id' => Criteria::factory(),
            'interview_result_id' => InterviewResult::factory(),
        ];
    }
}
