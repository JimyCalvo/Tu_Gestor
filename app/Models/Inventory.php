<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacturer;
use App\Models\ItemData;

class Inventory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'quantity', 'inventory_cost', 'repository_id', 'responsible_id'
    ];

    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }

     //------------------------- responsible-------------------------
    public function responsible()
    {
        return $this->belongsTo(User::class);
    }
    //------------------------- Items Data-------------------------
    public function itemData()
    {
        return $this->hasMany(ItemData::class);
    }


}
