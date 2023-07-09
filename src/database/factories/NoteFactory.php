<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 2),
            'prefecture_id' => 4,
            'title' => $this->faker->realText(15),
            'content' => $this->faker->realText(300),
            'created_at' => date('Y-m-d H:i:s'),
        ];
    }
}
