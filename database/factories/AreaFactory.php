<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Area;
class AreaFactory extends Factory
{
    protected $model = Area::class;

    public function definition()
    {
        return [
            'name_area' => $this->faker->words(2, true),
            'address_area' => $this->faker->address
        ];
    }
}
