<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemData;
use App\Models\Item;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_supplier', 'contact_name', 'phone_supplier',
        'tel_supplier', 'address_supplier'
    ];
    public function itemData()
    {
        return $this->belongsToMany(ItemData::class, 'itemdata_supplier', 'supplier_id', 'item_data_id');
    }

    public function addItemData($itemDataId)
    {
        $this->itemData()->attach($itemDataId);
    }
}
