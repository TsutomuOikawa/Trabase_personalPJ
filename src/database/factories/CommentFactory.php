<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'note_id' => $this->faker->numberBetween(1, 50),
            'user_id' => $this->faker->numberBetween(1, 20),
            'content' => $this->faker->realText(30),
            'created_at' => date('Y-m-d H:i:s'),
        ];
    }
}
