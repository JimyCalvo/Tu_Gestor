<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Manufacturer;

class ManufacturerFactory extends Factory
{
    protected $model = Manufacturer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->optional()->realText(200),
        ];
    }
}
