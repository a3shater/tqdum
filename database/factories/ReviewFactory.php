<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Review;
use App\Models\Reviewer;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'note' => $this->faker->word(),
            'reviewer_id' => Reviewer::factory(),
            'application_id' => Application::factory(),
        ];
    }
}
