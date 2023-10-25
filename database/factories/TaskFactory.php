<?php
namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;


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