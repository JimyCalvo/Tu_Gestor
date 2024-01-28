<?php

namespace Database\Factories;

use App\Models\ItemData;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemDataFactory extends Factory
{
    protected $model = ItemData::class;

    public function definition()
    {

        $quantity = $this->faker->numberBetween(1, 100);
        $unit_cost = $this->faker->randomFloat(2, 0, 100);
        return [
            'name_item' => $this->faker->word,
            'quantity' => $quantity,
            'unity_cost' =>$unit_cost,
            'total_cost' => $quantity * $unit_cost,
            'model' => $this->faker->word,
            'version' => $this->faker->word,
            'dimension' => $this->faker->word,
            'weight' => $this->faker->randomFloat(3, 0, 100),
            'color' => $this->faker->colorName,
            'total_items' => $this->faker->randomNumber(2),
            'items_price' => $this->faker->randomFloat(2, 0, 1000),
            'description' => $this->faker->text,
            'manufacturer_id' =>Manufacturer::factory(),
            'category_id' => Category::factory(),
        ];
    }
    // public function configure()
    // {
    //     return $this->afterCreating(function (ItemData $itemData) {
    //         $supplierIds = \App\Models\Supplier::pluck('id')->random(2)->toArray();
    //         $itemData->suppliers()->syncWithoutDetaching($supplierIds);
    //     });
    // }
}
