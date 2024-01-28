<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Supplier;


class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition()
    {
        return [
            'name_supplier' => $this->faker->company,
            'contact_name' => $this->faker->name,
            'phone_supplier' => $this->faker->phoneNumber,
            'tel_supplier' => $this->faker->numerify('##########'), // 10 dígitos
            'address_supplier' => $this->faker->address
        ];
    }
}
