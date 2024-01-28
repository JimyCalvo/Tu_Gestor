<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Other;
use App\Models\Item;


class OtherFactory extends Factory
{
    protected $model = Other::class;

    public function definition()
    {
        return [
            'tag' => $this->faker->word,
            'value' =>  $this->faker->numberBetween(0, 1000),
            'visible' => $this->faker->boolean,
            'description' => $this->faker->text,
            'item_id' => Item::factory(),
        ];
    }
}
