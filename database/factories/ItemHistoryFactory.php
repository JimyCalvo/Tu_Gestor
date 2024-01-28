<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Item;
use App\Models\ItemHistory;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemHistoryFactory extends Factory
{
    protected $model = ItemHistory::class;
    public function definition(): array
    {
        return [
            'item_id' => Item::factory(),
            'operation'=> $this->faker->word,
            'responsible_id' => User::factory(),
            'responsible_name' => $this->faker->name,
            'responsible_dni' => $this->faker->numerify('########'),
            'custody_id' => User::factory(),
            'custody_name' => $this->faker->name,
            'custody_dni' => $this->faker->numerify('########'),
        ];
    }
}
