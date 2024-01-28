<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Inventory;
use App\Models\User;
use App\Models\Repository;
class InventoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(0, 100),
            'inventory_cost' => $this->faker->randomFloat(2, 0, 1000),
            'repository_id'=>Repository::factory(),
            'responsible_id'=>User::factory(),
        ];
    }
}
