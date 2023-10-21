<?php

namespace Database\Factories;
use App\Models\_Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Factory\App\Models\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class _TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['P', 'I', 'C']);
        return [
            'title' => $title,
            'description'=> $this->faker->description(),
            'status'=> $status
        ];
    }
}
