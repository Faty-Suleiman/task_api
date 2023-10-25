<?php

namespace Database\Factories;
use Illuminate\Support\Facades\Factory;

// use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

use Faker\Factory as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */


class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        $status = $this->faker->randomElement(['P', 'I', 'C']);

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $status,
        ];
    }
}