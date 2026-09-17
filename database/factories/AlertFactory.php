<?php

namespace Database\Factories;

use App\Models\Alert;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Alert>
 */
class AlertFactory extends Factory
{
    protected $model = Alert::class;

    public function definition(): array
    {
        $startsAt = fake()->dateTimeBetween('-1 month', '+1 month');

        return [
            'title' => fake()->sentence(5),
            'content' => fake()->paragraph(),
            'starts_at' => $startsAt,
            'ends_at' => fake()->dateTimeBetween($startsAt, '+2 months'),
        ];
    }
}
