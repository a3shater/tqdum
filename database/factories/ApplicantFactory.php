<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Applicant;
use App\Models\User;

class ApplicantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Applicant::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'contact_info' => $this->faker->word(),
            'address' => $this->faker->word(),
            'qualification' => $this->faker->word(),
            'gender' => $this->faker->word(),
        ];
    }
}
