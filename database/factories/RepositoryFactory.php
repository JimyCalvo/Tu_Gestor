<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Repository;
use App\Models\User;
use App\Models\Area;

class RepositoryFactory extends Factory
{
    protected $model = Repository::class;

    public function definition()
    {
        return [
            'repository_name' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(0, 100),
            'repository_cost' => $this->faker->randomFloat(2, 0, 10000),
            'area_id'=>Area::factory(),
            'guardian_id'=>User::factory(),
            
        ];
    }
}
