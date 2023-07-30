<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 20),
            'prefecture_id' => $this->faker->numberBetween(1, 47),
            'title' => $this->faker->realText(10),
            'content' => '{
                "time":'.now()->format('U').',
                "blocks":[
                    {
                        "id":"pZy-xfgRQM",
                        "type":"header",
                        "data":{
                            "text":"'.$this->faker->realText(15).'",
                            "level":2
                        }
                    },
                    {
                        "id":"y-yFhbSHnE",
                        "type":"paragraph",
                        "data":{
                            "text":"'.$this->faker->realText(40).'"
                        }
                    }
                ],
                "version":"2.26.4"
            }',
            'created_at' => date('Y-m-d H:i:s'),
        ];
    }
}
