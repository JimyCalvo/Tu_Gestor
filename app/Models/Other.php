<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Item;

class Other extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'model', 'version', 'dimension', 'weight', 'date_exp',
        'color', 'extra_1', 'extra_2', 'extra_3', 'extra_4',
        'extra_5', 'extra_6', 'extra_7', 'extra_8', 'extra_9',
        'items_list_id'
    ];


    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }

}
