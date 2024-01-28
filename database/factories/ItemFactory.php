<?php

namespace Database\Factories;
use App\Models\Inventory;
use App\Models\User;
use App\Models\ItemData;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{

    protected $model = Item::class;

    public function definition()
    {
        return [
            'status' => $this->faker->word,
            'comment' => $this->faker->sentence,
            'check_date' => $this->faker->date(),
            'unique_code' => $this->faker->bothify('???-####'),
            'inventory_id' => Inventory::factory(),
            'custody_id' => User::factory(),
            'item_data_id' => ItemData::factory(),
            'supplier_id' => Supplier::factory(),
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Item $item) {
            $supplier = Supplier::find($item->supplier_id);
            if ($supplier) {
                $supplier->addItemData($item->item_data_id);
            }
            $item->itemHistory()->create([
                'operation' => 'create',
                'responsible_id' => $item->inventory->responsible->id,
                'responsible_name' => $item->inventory->responsible->full_name,
                'responsible_dni' => $item->responsible->profile->dni ?? $item->responsible->profile->passport ?? null,
                'custody_id' => $item->custody_id,
                'custody_name' => $item->custody->full_name,
                'custody_dni' => $item->custody->profile->dni ?? $item->custody->profile->passport ?? null,
            ]);


        });
    }


}
