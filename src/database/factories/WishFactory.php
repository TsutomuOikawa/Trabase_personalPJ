<?php

namespace Database\Factories;

use App\Models\Wish;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wish>
 */
class WishFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     *
     * @var string
     */
    protected $model = Wish::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 20),
            'prefecture_id' => $this->faker->numberBetween(1, 2),
            'spot' => $this->faker->realText(10),
            'thing' => $this->faker->realText(15),
            'created_at' => date('Y-m-d H:i:s'),
        ];
    }
}
