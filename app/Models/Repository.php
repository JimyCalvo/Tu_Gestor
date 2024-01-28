<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Inventory;
use App\Models\User;


class Repository extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_repository','quantity', 'repository_cost', 'area_id', 'guardian_id'
    ];
     //------------------------- area-------------------------
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    //------------------------- guardian-------------------------
    public function guardian()
    {
        return $this->belongsTo(User::class);
    }
    //------------------------- inventory-------------------------
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'repository_id');
    }
}
