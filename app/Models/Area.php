<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use App\Models\Repository;

class Area extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name_area', 'address_area'
    ];
    ////////////////////////////////////////////////////////////////

    //-------------------------profiles------------------------
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
     //------------------------- Repositories-------------------------
     public function repositories()
     {
         return $this->hasOne(Repository::class);
     }

}
