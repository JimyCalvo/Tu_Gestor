<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'full_name',
        'role_id',
        'email',
        'password',
        'email_verified_at'
    ];


    protected $hidden = [
        'password',
        'remember_token',
        
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    // ------------------------- Roles -------------------------
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    //------------------------- Profiles-------------------------
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    //------------------------- Repositories-------------------------
    public function repositories()
    {
        return $this->hasMany(Repository::class, 'guardian_id');
    }
    //------------------------- inventory-------------------------
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'responsible_id');
    }

    //------------------------- Item-------------------------
    public function items()
    {
        return $this->hasMany(Item::class, 'custody_id');
    }

    //------------------------- History Item-------------------------
    public function histCustody()
    {
        return $this->hasMany(ItemHistory::class, 'custody_id');
    }
    public function histResp()
    {
        return $this->hasMany(ItemHistory::class, 'responsible_id');
    }


}
