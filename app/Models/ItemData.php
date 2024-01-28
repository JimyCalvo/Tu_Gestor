<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Manufacturer;

class ItemData extends Model
{
    use HasFactory;
    protected $table = 'items_data';

    protected $fillable = [
        'name_item',
        'quantity',
        'unity_cost',
        'total_cost',
        'model',
        'version',
        'dimension',
        'weight',
        'color',
        'total_items',
        'items_price',
        'description',
        'manufacturer_id',
        'category_id',
    ];
    public $timestamps = false;

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'itemdata_supplier', 'item_data_id', 'supplier_id');
    }
    public function items()
    {
        return $this->hasMany(Item::class, 'item_id');
    }



}
