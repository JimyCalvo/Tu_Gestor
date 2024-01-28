<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'other_name',
        'type',
        'title',
    ];
    public function Other()
    {
        return $this->belongsToMany(Other::class);
    }
}
