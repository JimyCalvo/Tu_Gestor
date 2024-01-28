<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Inventory;
use App\Models\User;
use App\Models\Other;
use App\Models\ItemData;
use App\Models\Profile;

use App\Models\InventoryEntry;
use App\Models\InventoryExit;
use App\Models\ItemHistory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'item_data_id',
        'unique_code',
        'status',
        'check_date',
        'inventory_id',
        'custody_id',
        'comment',
        'supplier_id'

    ];

    public function custody()
    {
        return $this->belongsTo(User::class, 'custody_id');
    }

    public function profile()
    {
        return $this->custody()->profile();
    }

    public function itemData()
    {
        return $this->belongsTo(ItemData::class, 'item_data_id');
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class,'supplier_id');
    }

    public function manufacturer()
    {
        return $this->itemData()->manufacturer();
    }

    public function category()
    {
        return $this->itemData()->category();
    }

     //------------------------- inventory-------------------------

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
    public function responsible()
    {
        return $this->inventory->responsible();
    }

    public function repository()
    {
        return $this->inventory()->repository();
    }
    public function area()
    {
        return $this->inventory()->repository()->area();
    }
    public function guardianRepository()
    {
        return $this->inventory()->repository()->guardian();
    }

     //------------------------- other-------------------------


    public function other()
    {
        return $this->hasMany(Other::class);
    }



    //------------------------- History Item-------------------------
      public function itemHistory()
      {
          return $this->hasMany(ItemHistory::class, 'item_id');
      }

}
