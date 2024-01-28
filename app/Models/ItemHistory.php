<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;

class ItemHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'operation',
        'responsible_id',
        'responsible_name',
        'responsible_dni',
        'custody_id',
        'custody_name',
        'custody_dni',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }

    public function custody()
    {
        return $this->belongsTo(User::class, 'custody_id');
    }
}
